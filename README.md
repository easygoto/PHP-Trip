# PHP之旅

- [x] 整理项目结构
    - [x] 把设计模式迁移进来
    - [x] 将单例模式替换为注入依赖模式
    - [x] ~~组件适配, 同类组件统一方法~~
    - [x] 配置文件提取到 .env 中
        - [ ] Setting 组件添加默认值
    - [x] 把传统的前端页面迁移进来
- [x] 完善其他组件
    - [ ] 日志相关
    - [ ] 缓存相关
    - [ ] 消息队列相关
    - [ ] 关系型数据库
    - [ ] 非关系型数据库
    - [ ] 系统文件操作相关
    - [ ] 命令行相关
- [ ] 完善其他工具
    - [ ] 数组/对象/赋值相关
    - [ ] 格式化/序列化相关
    - [ ] 请求参数/返回结果
    - [x] 图片处理相关
        - [ ] 处理透明图片
    - [x] 网络请求相关
        - [ ] 基于 PSR-18 http client
    - [ ] 计时器(分析程序执行时间)
- [ ] 校验链/业务链
- [ ] 数据调用中心/数据的唯一性
- [ ] 数据库更新策略
- [ ] MVC 架构研究
    - [x] 路由处理
    - [ ] 模型
    - [x] 控制器
    - [x] 视图
        - [x] 传统页面改写为框架兼容代码
        - [ ] 资源/页面等组件
- [ ] 测试框架的深入研究
- [ ] 集合命令行框架
- [x] Swoole 研究
    - [ ] 高并发测试工具
- [ ] 系统模块监视器

## 1 结构

> [学习设计模式](dp/README.md)
>
> [Swoole 专栏](SWOOLE.md)

```
<root>
 |-- app : 应用目录
 |-- console : 命令行工具
 |-- core : 核心库和组件, 可以提取到其他项目
     |-- Component : 组件, 基于自己理解完成的 psr 组件
     |-- Helper : 工具方法, 常用的工具方法
 |-- data : 配置及数据
     |-- backup : 备份文件, sql 改动
     |-- config : 配置文件
     |-- docs : 文档
     |-- temp : 缓存
 |-- dp : 学习设计模式的目录
 |-- public : 网站根目录
     |-- demo : 大部分的前端应用, 整理后移除
     |-- assets
         |-- images : 资源图片
         |-- css
         |-- js
         |-- fonts
     |-- upload
         |-- images
         |-- excel
 |-- src : 组件、工具等
     |-- Container : 容器, 常量
     |-- Component : 二次封装带有逻辑的组件
     |-- Model : 数据库对接层
     |-- Service : 业务逻辑层
     |-- Controller : 控制路由层
     |-- View : 视图层
     |-- Helper : 二次封装带有逻辑的库
 |-- tests : 测试板块
 |-- tests : 测试板块
```

## 2 规范

| 规范 | 名称 | 推荐(composer) |
| --- | --- | --- |
| PSR-3 | 日志 [psr/log](https://github.com/psr/log) | [monolog/monolog](https://github.com/Seldaek/monolog) |
| PSR-6 | 缓存 [psr/cache](https://github.com/psr/cache) | [tedivm/stash](https://github.com/tedious/Stash) 或 [psx/cache](https://github.com/apioo/psx-cache) |
| PSR-7 | HTTP消息 [psr/http-message](https://github.com/psr/http-message) | [guzzlehttp/psr7](https://github.com/guzzle/psr7) |
| PSR-11 | 容器 [psr/container](https://github.com/psr/container) | [league/container](https://github.com/thephpleague/container) |
| PSR-13 | 超媒体链接 [psr/link](https://github.com/psr/link) | [fig/link-util](https://github.com/php-fig/link-util) |
| PSR-14 | 事件分发 [psr/event-dispatcher](https://github.com/psr/event-dispatcher) | [crell/tukio](https://github.com/Crell/Tukio) |
| PSR-15 | HTTP请求处理器 [psr/http-server-handler](https://github.com/psr/http-server-handler) | [equip/dispatch](https://github.com/equip/dispatch) |
| PSR-15 | HTTP请求处理器 [psr/http-server-middleware](https://github.com/psr/http-server-middleware) | [middlewares/request-handler](https://github.com/middlewares/request-handler) |
| PSR-16 | 缓存 [psr/simple-cache](https://github.com/psr/simple-cache) | [psx/cache](https://github.com/apioo/psx-cache) |
| PSR-17 | HTTP工厂 [psr/http-factory](https://github.com/psr/http-factory) | [http-interop/http-factory-guzzle](https://github.com/http-interop/http-factory-guzzle) |
| PSR-18 | HTTP客户端 [psr/http-client](https://github.com/psr/http-client) | [ricardofiorani/guzzle-psr18-adapter](https://github.com/ricardofiorani/guzzle-psr18-adapter) |

## 3 实验

### 3.1 商品秒杀

#### 3.1.1 介绍

> [秒杀源码](./app/Logic/Spike.php) 可以使用并发测试工具测试 `<domain>/index.php/spike/mysql`

#### 问题及解决方案

> 多线程测试时会出现 (顾客买到数量 + 剩余量 > 总库存量) 的问题, 原因是高并发的情况下, 那一行数据可能有多个线程在使用, 没有行锁, 简单处理可以把加减放到 SQL 语句中 :
>
> `update table set inventory = inventory - {x} where id = {id}`

> 商品超卖, 使得数据库中某一商品变成负数, 原因同上
>
>> 最简单的方法就是把库存字段设置成 unsigned 类型, 和事务一起使用, 本例就是用这种方法 
>
>> 也可以简单的使用 SQL 语句优化:
>>
>> `update table set inventory = inventory - {x} where id = {id} and inventory >= {x}`
>
>> 也可以运用缓存建锁, 每次只能让一个线程使用数据:
>>
>> ```php
>> $lock = Lock::getInstance();
>> while (!$lock->isLock()) {
>>     // 建议这里加入次数限制或时间限制
>>     $lock->lock();
>>     // TODO
>>     $lock->unlock();
>>     break;
>> }
>> ```
>
>> 还可以利用 redis 的 watch 命令:
>>
>> ```php
>> $numKey = 'test:spike:goods_num';
>> $redis = new Redis();
>> $redis->watch($numKey);
>> $num = $redis->get($numKey);
>> usleep(100); # 耗时操作
>> if ($num <= 0) {
>>     return;
>> }
>> $redis->multi();
>> $redis->decr($numKey);
>> $redis->exec();
>> ```

### 3.2 一致性哈希算法

> [源代码](app/Distribute)
>
> [测试代码](tests/App/MemcachedTest.php), 使用 `distribute` 方法

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




