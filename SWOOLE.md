## Swoole 学习笔记

### 1 安装准备

> 使用自己编译的 docker 镜像 registry.cn-hangzhou.aliyuncs.com/treelink/php:7.4-swoole
>
> 基于 php-fom:7.4 增加了 swoole, swoole_async, swoole_orm, swoole_postgresql, mongodb, redis, memcached, imagick, apcu 等扩展
>
> 开启 debug-log 或 trace-log 之后, 命令行会打印很多日志的日志, 如果不是特别需要, 建议不开启
>
> swoole_async 是异步写法, 目前被协程取代, 地址为 https://github.com/swoole/ext-async, 编译时版本要和 swoole 的版本保持一致

#### 1.1 存在的问题

- [ ] gdb 调试总是打不上断点直接运行
- [ ] 深入事件的了解

### 2 协程

#### 2.1 协程的创建

1. 父协程结束不影响子协程
1. 同级别的协程才会受到 co:sleep() 的影响
1. 协程是按一定顺序执行, 有时候脚本执行完毕, 协程还没有完全关闭
1. Co\run() 是创建一个协程容器, 容器内的程序可以异步, 容器外的程序是正常同步的
1. go() 等同于 co::create()

```php
# main start
# co-1 start
# co-1.1 start
# co-2 start
# co-3 start
# Obj::test: 3857870d24cef1d56e3f7d33db87efca: 1b67e181fbe59f93c092a24cde107d39
# Obj::test: 01bff6f459e2c02168e010612bb102a0: 6e67c633b3b63b6aa92763e767c53d92
# Obj::test: bd8f66c0681b9c4d7887558bca794c15: e0aa02ade4c4173ef18c9f654e606f30
# main end
# {"0":9,"1":2,"2":1,"3":3,"4":4,"5":5,"6":7} // 保存了当前正在运行的协程
# [[1,-1],[2,1],[3,-1],[4,-1],[5,-1],[6,-1],[7,-1],[8,-1],[9,-1],[10,-1]] // co-1.1.1 co-1.2 在此后才开始, 所以没有统计上
# 0. test: 920c2165487233f0cae8a99bc8c18621
# co-1.1.1 start
# co-1.1 end
# 1. test: 9f276834a68f9482b8c8c0a63ac45201
# co-1.2 start
# co-1 end
# co-1 close and db close
# 2. test: dec943e9decfc36d91f9e47022426630
# co-2 end
# co-3 end
# co-1.1.1 end
# co-1.2 end

class Obj
{
    private string $id = '';

    public function __construct()
    {
        $this->id = md5(uniqid(rand(1e10, 1e11 - 1) . microtime()));
    }

    public function test($i)
    {
        global $cidList;
        $cidList[] = [co::getCid(), co::getPcid()];
        echo __METHOD__ . ": {$i}: {$this->id}\n";
    }
}

function test($i, $j)
{
    global $cidList;
    $cidList[] = [co::getCid(), co::getPcid()];
    co::sleep($i / 5 + .001);
    echo "{$i}. " . __FUNCTION__ . ": {$j}\n";
}

Co\run(function () {
    echo "main start\n";
    global $cidList;
    $cidList = [];

    go(
        function () {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-1 start\n";
            defer(
                function () {
                    echo "co-1 close and db close\n";
                }
            );
            go(
                function () {
                    global $cidList;
                    $cidList[] = [co::getCid(), co::getPcid()];
                    echo "co-1.1 start\n";
                    co::sleep(.2);
                    go(
                        function () {
                            global $cidList;
                            $cidList[] = [co::getCid(), co::getPcid()];
                            echo "co-1.1.1 start\n";
                            co::sleep(.5);
                            echo "co-1.1.1 end\n";
                        }
                    );
                    echo "co-1.1 end\n";
                }
            );
            co::sleep(.3);
            go(
                function () {
                    global $cidList;
                    $cidList[] = [co::getCid(), co::getPcid()];
                    echo "co-1.2 start\n";
                    co::sleep(.4);
                    echo "co-1.2 end\n";
                }
            );
            co::sleep(.1);
            echo "co-1 end\n";
        }
    );

    $cid = go(
        function () {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-2 start\n";
            co::yield();
            echo "co-2 end\n";
        }
    );

    go(
        function () use ($cid) {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-3 start\n";
            co::sleep(0.5);
            co::resume($cid);
            echo "co-3 end\n";
        }
    );

    for ($i = 0; $i < 3; $i++) {
        co::create('test', $i, md5(uniqid(microtime())));
        go([new Obj(), 'test'], md5(uniqid(microtime())));
    }

    echo "main end\n";
    echo json_encode(co::listCoroutines()) . "\n";
    echo json_encode($cidList) . "\n";
});
```

#### 2.2 通道

1. 本质上是队列, 先进先出, 可以存放 PHP 对象
1. 当队列满的时候, 其他的协程会插队, 会影响到先前的顺序

```php
<?php
// 多生产/多消费模型操作队列
// 预期队列的空满状态可以通过更改 chan 中的 size 来实现
Co\run(
    function () {
        global $inQueue, $outQueue;
        $inQueue = [];
        $outQueue = [];
        $chan = new chan(10);
        go(
            function () use ($chan) {
                for ($i = 0; $i < 10; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-1: {$i}";
                    $chan->push(['index' => "chan-1: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.2);
                }
            }
        );
        go(
            function () use ($chan) {
                for ($i = 0; $i < 20; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-2: {$i}";
                    $chan->push(['index' => "chan-2: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.1);
                }
            }
        );
        go(
            function () use ($chan) {
                for ($i = 0; $i < 15; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-3: {$i}";
                    $chan->push(['index' => "chan-3: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.15);
                }
            }
        );

        go(
            function () use ($chan) {
                while (true) {
                    global $outQueue;
                    $data = $chan->pop();
                    $outQueue[] = $data['index'] ?? '-';
                    co::sleep(0.2);
                    echo json_encode(['length' => $chan->length(), 'data' => $data]) . "\n";
                }
            }
        );
        go(
            function () use ($chan) {
                while (true) {
                    global $outQueue;
                    $data = $chan->pop();
                    $outQueue[] = $data['index'] ?? '-';
                    co::sleep(0.3);
                    echo json_encode(['length' => $chan->length(), 'data' => $data]) . "\n";
                }
            }
        );
    }
);

global $inQueue, $outQueue;
echo json_encode($inQueue) . "\n";
echo json_encode($outQueue) . "\n";
```

#### 2.3 WaitGroup

1. 可以通过控制, 使所有的协程都结束才会处理某些事情
1. `存疑` 共享的数组资源不能使用 array_merge() 函数

```php
<?php

use Swoole\Coroutine\Http\Client;
use Swoole\Coroutine\WaitGroup;

function accessDomain($domain)
{
    // 使用 https 时, 需要在 swoole 编译的时候加上 --enable-openssl
    $cli = new Client($domain, 443, true);
    $cli->setHeaders(
        [
            'Host' => $domain,
            'User-Agent' => 'Chrome/80.0.3987.149',
            'Accept' => 'text/html,application/xhtml+xml,application/xml',
            'Accept-Encoding' => 'gzip',
        ]
    );
    $cli->set(['timeout' => 1]);
    $cli->get('/');
    $cli->close();
    co::sleep(rand(1, 10) / 5);
    return [$domain => $cli->headers];
}

Co\run(
    function () {
        $wg = new WaitGroup();
        $domainList = ['www.taobao.com', 'www.qq.com', 'www.163.com', 'www.baidu.com'];
        $result = [];

        foreach ($domainList as $domain) {
            $wg->add();
            go(
                function () use ($wg, &$result, $domain) {
                    // 这里使用 array_merge 函数后, 只能保存一个结果
                    $result[] = accessDomain($domain);
                    $wg->done();
                }
            );
        }

        $wg->wait();
        echo json_encode($result) . "\n";
    }
);
```

#### 2.4 连接池

1. 协程中的连接都是并行的, 连接池只需要连接数据库一次
2. 一个连接池只有一个进程
3. pdo, redis, mysqli 创建连接池的方法基本类似

```php
<?php

declare(strict_types=1);

use Swoole\Coroutine;
use Swoole\Database\PDOConfig;
use Swoole\Database\PDOPool;

const N = 1024;
$pool = new PDOPool(
    (new PDOConfig())
        ->withHost('host.docker.internal')
        ->withPort(3306)
        ->withDbName('test')
        ->withCharset('utf8mb4')
        ->withUsername('root')
        ->withPassword('123123')
);

function todo(PDOPool $pool)
{
    $pdo = $pool->get();
    $sql = 'insert into test (name, money, created_at) values (?, ?, ?)';
    $statement = $pdo->prepare($sql);
    if (!$statement) {
        throw new RuntimeException('Prepare failed');
    }
    $name = substr(md5(uniqid(microtime())), 0, 10);
    $money = rand(-9999999999, 9999999999) / 100;
    $createdAt = date('Y-m-d H:i:s', time() - rand(0, 100 * 365 * 86400));
    $result = $statement->execute([$name, $money, $createdAt]);
    if (!$result) {
        throw new RuntimeException('Execute failed');
    }
    $pool->put($pdo);
}

for ($i = 1; $i <= 10; $i++) {
    $s = microtime(true);
    Coroutine\run(
        function () use ($pool) {
            for ($n = N; $n--;) {
                go(fn () => todo($pool));
            }
        }
    );
    $s = microtime(true) - $s;
    flush();
    echo $i . ': Use ' . $s . 's for ' . N . ' queries' . PHP_EOL;
}

$pool->close();
```

#### 2.5 定时器

> 最大的感触就是和 js 中的定时器一样, 值得注意的是 Swoole\Timer::tick 非阻塞但程序会一直跑下去

### 3 进程

#### 3.1 共享内存

> Swoole\Table 更像是内存中共享的仿数据库的表, 进程结束自动释放

```php
<?php

use Swoole\Table;

$table = new Table(1024);
$table->column('name', Table::TYPE_STRING, 64);
$table->column('age', Table::TYPE_INT, 2);
$table->column('money', Table::TYPE_FLOAT);
$table->create();

$table->set('test:table1', ['name' => 'admin', 'age' => 18, 'money' => 100]);
$table->incr('test:table1', 'age', 2);
echo json_encode($table->get('test:table1')), "\n"; # {"name":"admin","age":20,"money":100}

$table['test:table2'] = ['name' => 'root', 'age' => 20, 'money' => 100];
$table->decr('test:table2', 'age', 2);
echo json_encode($table['test:table2']), "\n"; # {"key":"test:table2","value":{"name":"root","age":18,"money":100}}
```

#### 3.2 同步

> 无锁计数器, 属于数据不安全的计数器; 让协程在 0-50 以内做计算, 有计算出界的情况, 加锁(悲观锁)之后就可以防止这种情况
>
> 进程锁只能在子进程之间使用, 在协程中使用会出现死锁

```php
<?php

use Swoole\Atomic;
use Swoole\Lock;
use Swoole\Process;

# 20 + 24 = 44
# invalid + 30, keep 44
# invalid + 30, keep 44
# 44 - 16 = 28
# 28 - 15 = 13
# invalid - 18, keep 13
# invalid - 14, keep 13
# invalid - 16, keep 13

$atomic = new Atomic();
$atomic->set(20);
$lock = new Lock(Lock::MUTEX);
$addNum = 3;
$subNum = 5;

for ($i = 0; $i < $addNum; $i++) {
    $process = new Process(
        function () use ($atomic, $lock) {
            $lock->lock();
            $rand = rand(20, 30);
            if ($atomic->get() + $rand <= 50) {
                usleep(5e5);
                echo "{$atomic->get()} + {$rand} = {$atomic->add($rand)}\n";
            } else {
                echo "invalid + {$rand}, keep {$atomic->get()}\n";
            }
            $lock->unlock();
        }
    );
    $process->start();
}

for ($i = 0; $i < $subNum; $i++) {
    $process = new Process(
        function () use ($atomic, $lock) {
            $lock->lock();
            $rand = rand(10, 20);
            if ($atomic->get() - $rand >= 0) {
                usleep(5e5);
                echo "{$atomic->get()} - {$rand} = {$atomic->sub($rand)}\n";
            } else {
                echo "invalid - {$rand}, keep {$atomic->get()}\n";
            }
            $lock->unlock();
        }
    );
    $process->start();
}

for ($i = $addNum + $subNum; $i > 0; $i--) {
    $status = Process::wait();
    echo json_encode($status) . "\n";
}
```

#### 3.3 进程管理

> 主进程是阻塞的, 子进程之间是异步的, 回收所有子进程之后主进程才会停止
>
> 子进程可以先于协程结束, 但只有子进程中的协程完毕了之后, 才会被系统回收

```php
<?php

use Swoole\Process;

for ($n = 1; $n <= 3; $n++) {
    $process = new Process(
        function () use ($n) {
            echo 'Child #' . getmypid() . " start and sleep {$n}s" . PHP_EOL;
            sleep($n);
            for ($i = 1; $i <= 3; $i++) {
                go(
                    function () use ($i) {
                        co::sleep($i);
                        echo 'Child #' . getmypid() . " co {$i} run" . PHP_EOL;
                    }
                );
            }
            echo 'Child #' . getmypid() . ' exit' . PHP_EOL;
        }
    );
    $process->start();
}
for ($n = 3; $n--;) {
    $status = Process::wait(true);
    echo "Recycled #{$status['pid']}, code={$status['code']}, signal={$status['signal']}" . PHP_EOL;
}
echo 'Parent #' . getmypid() . ' exit' . PHP_EOL;
```

```php
<?php

use Swoole\Process\Pool as ProcessPool;

# 进程池主要应用于开启多个子进程的服务, 以增大并发量
$workerNum = 8;
$pool = new ProcessPool($workerNum);

$pool->on(
    "WorkerStart",
    function (ProcessPool $pool, $workerId) {
        echo "Worker#{$workerId} is started\n";
        sleep(rand(2, 8));
    }
);

$pool->on(
    "WorkerStop",
    function (ProcessPool $pool, $workerId) {
        echo "Worker#{$workerId} is stopped\n";
    }
);

$pool->start();
```

### 4 服务端

#### 4.1 TCP 服务器

#### 4.2 HTTP 服务器

#### 4.3 WS 服务器

#### 4.4 Redis 服务器

### 5 客户端

#### 5.1 TCP/UDP 客户端

#### 5.2 HTTP/WS 客户端

#### 5.3 HTTP2 客户端

#### 5.4 Socket 客户端

#### 5.5 PgSQL 客户端

#### 5.6 MySQL 客户端

#### 5.7 Redis 客户端

#### 5.8 System 客户端

### 6 Swoole Async

#### 6.1 系统处理

```php
<?php

use Swoole\Async;

# 异步读取/写入文件, 执行命令
Async::readFile(__DIR__ . '/read.txt', function (...$args) {
    // $filename, $content
    echo json_encode($args), "\n";
});

Async::writeFile(__DIR__ . '/write.txt', 'hello swoole', function (...$args) {
    // $filename, $length
    echo json_encode($args), "\n";
});

Async::exec('php tesst.php', function (...$args) {
    // $result, $bool
    echo json_encode($args), "\n";
});

echo "start\n";
```

### 7 Swoole ORM

