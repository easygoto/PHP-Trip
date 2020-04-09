# PHP之旅

- [x] 整理项目结构
- [x] 把设计模式迁移进来
- [x] 将单例模式替换为注入依赖模式
- [x] ~~组件适配, 同类组件统一方法~~
- [x] 完善其他组件
    - [ ] 日志相关
    - [ ] 缓存相关
    - [ ] 消息队列相关
    - [ ] 关系型数据库
    - [ ] 非关系型数据库
    - [ ] 系统文件操作相关
- [ ] 完善其他工具
    - [ ] 数组/对象/赋值相关
    - [ ] 格式化/序列化相关
    - [ ] 请求参数/返回结果
    - [x] 图片处理相关
        - [ ] 处理透明图片
    - [x] 网络请求相关
    - [ ] 计时器(分析程序执行时间)
- [ ] 校验链/业务链
- [ ] 数据调用中心/数据的唯一性
- [ ] 数据库更新策略
- [ ] MVC 架构研究
    - [x] 路由处理
    - [ ] 模型
    - [x] 控制器
    - [ ] 视图
- [ ] 测试框架的深入研究
    - [ ] phpunit 9.0
    - [ ] 集成单元测试
- [x] Swoole 研究
- [ ] 高并发下的 redis id 增长

## 1 项目结构

> [学习设计模式](dp/README.md)
> [Swoole 专栏](SWOOLE.md)

```
<root>
 |-- app : 应用目录
 |-- console : 命令行工具
 |-- core : 核心库
     |-- Component : 组件, 一般放在容器中注入依赖
     |-- Container : 容器, 常量
     |-- Helper : 工具方法, 之间不可有依赖关系
 |-- data : 配置及数据
     |-- backup : 备份文件, sql 改动
     |-- config : 配置文件
     |-- docs : 文档
     |-- temp : 缓存
 |-- dp : 学习设计模式的目录
 |-- public : 网站根目录
     |-- demo : 大部分的前端应用
     |-- resource
         |-- images : 资源图片
         |-- wxcode : 微信码
     |-- upload
         |-- images
 |-- src : 组件、工具等
     |-- Container : 带有逻辑的常量和容器
     |-- Component : 带有逻辑的组件
     |-- Model : 数据库对接层
     |-- Service : 业务逻辑层
     |-- Controller : 控制路由层
     |-- View : 页面显示层
     |-- Helper : 带有逻辑的库
 |-- tests : 测试板块
```

## 2 项目规范

- 基础规范为 PSR-12

### 2.1 组件规范

- 组件可以依赖工具、其他组件
- 组件使用非静态的方法处理事情

## 3 项目实验

### 3.1 商品秒杀

> [秒杀源码](./app/Logic/Spike.php) 可以使用并发测试工具测试 `index.php/spike/mysql`

> 多线程测试时会出现 (顾客买到数量 + 剩余量 > 总库存量) 的问题, 原因是高并发的情况下, 那一行数据可能有多个线程在使用, 没有行锁, 简单处理可以把加减放到 SQL 语句中 :
>
> `update table set inventory = inventory - {x} where id = {id}`

> 商品超卖, 使得数据库中某一商品变成负数, 原因同上, 最简单的方法就是把库存字段设置成 unsigned 类型, 和事务一起使用, 本例就是用这种方法 
>
> 也可以运用缓存建锁, 每次只能让一个线程使用数据:
>
> ```php
> $lock = Lock::getInstance();
> while (!$lock->isLock()) {
>     // 建议这里加入次数限制或时间限制
>     $lock->lock();
>     // TODO
>     $lock->unlock();
>     break;
> }
> ```
>
> 也可以简单的使用 SQL 语句优化:
>
>`update table set inventory = inventory - {x} where id = {id} and inventory >= {x}`
>
> 还可以利用 redis 的 watch 命令:
>
> ```php
> $numKey = 'test:spike:goods_num';
> $redis = new Redis();
> $redis->watch($numKey);
> $num = $redis->get($numKey);
> usleep(100); # 耗时操作
> if ($num <= 0) {
>     return;
> }
> $redis->multi();
> $redis->decr($numKey);
> $redis->exec();
> ```

### 3.2 一致性哈希算法

> [源代码](app/Distribute)
>
> [测试代码](tests/App/MemcacheTest.php), 使用 `distribute` 方法

### 3.3 Swoole 专栏

> [详情请看 SWOOLE.md](SWOOLE.md)

### 3.4 令牌桶算法限流

> [令牌桶源码](app/Limiting/TokenBucket.php)

```php
# 测试代码, 建议使用压力测试工具执行此脚本

$tokenBucket = TokenBucket::instance();
$result = $tokenBucket->add();

sleep(1); # 某些耗时操作

if ($result) {
    $id = $tokenBucket->get();
    file_put_contents(TEMP_DIR . "token/success_{$id}", '');
    echo 'success';
} else {
    file_put_contents(TEMP_DIR . 'token/fail_' . md5(uniqid(microtime())), '');
    header('HTTP/1.1 403 Forbidden', true, 403);
}
```

### 3.5 Redis 特性

> 特性测试代码均在 [tests/App/RedisTest](tests/App/RedisTest.php) 中

#### 3.5.1 发布订阅

> 推送使用的是 `publish` 方法
> 
> 接收使用的是 `subscribe` 方法

#### 3.5.2 地理 API GEO

> 地理 API 使用 `geo` 方法, 计算经纬度距离, 筛选经纬度范围坐标

#### 3.5.3 位图

> 使用 `bitmap` 方法, 大量的 true/false 统计能节省不少空间, 但是比较少的数量建议不使用这种数据类型, 当然也可以使用更小的 hyperloglog

#### 3.5.4 hyperloglog

> 使用 `hyper` 方法, 统计百万级的独立用户, 每天向内存中输入 1e6 的用户 ID, 可能只需几十 kb 的内存
>
> 但好用的东西不完美, 不是 0 失误率(每次的 count 不一样), 不能取出单条的数据

#### 3.5.5 pipeline

> 使用 `pipeline` 方法, 节省大量时间
>
> n 次命令的执行可能会有 n 次的网络传输, 放到 pipeline 中, 一次网络请求就可以执行多条命令(此时仍然是原子级别), 然后依次返回结果集
>
> 注意 pipeline 携带的数据量, 每次只作用于一个 Redis 节点

### 3.6 消息队列

> amqp 和 php-libamqp 的性能比较, [建议在 cli 环境下执行](console/mq.php)
>
> 保证结构一致且是空队列的情况. 十万级的数目, amqp 比 libamqp 的效率高 40% ~ 60%; 万级的数目, amqp 比 libamqp 的效率高 100% ~ 110%
>
> [amqp 的源码](app/MQ/AmqpDemo.php) 和 [libamqp 的源码](app/MQ/LibMqDemo.php)




