# PHP之旅

## 目录

- [简介](README.md#1-简介)
    - [项目结构](README.md#11-结构)
    - [项目规范](README.md#12-规范)
- [设计](README.md#2-设计)
- [案例](README.md#3-案例)
    - [商品秒杀](README.md#31-商品秒杀)
    - [一致性哈希算法](README.md#32-一致性哈希算法)
    - [令牌桶算法限流](README.md#33-令牌桶算法限流)
    - [Redis-特性](README.md#34-Redis-特性)
    - [消息队列](README.md#35-消息队列)
- [Swoole 专栏](SWOOLE.md)
- [设计模式源码](dp)

## 待办计划

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

# 1 简介

## 1.1 结构

```
<root>
 |-- app : 应用目录
 |-- console : 命令行工具
 |-- core : 核心库和组件, 可以提取到其他项目
     |-- Component : 组件, 基于自己理解完成的 psr 组件
     |-- Helper : 工具方法, 常用的工具方法
 |-- data : 配置及数据
     |-- backup : 备份文件, sql 改动
     |-- docs : 文档
     |-- temp : 缓存
 |-- dp : 学习设计模式的目录
 |-- public : 网站根目录
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
```

## 1.2 规范

| 规范 | 名称 | 推荐(composer) |
| --- | --- | --- |
| PSR-3 | 日志 [psr/log](https://github.com/php-fig/log) | [monolog/monolog](https://github.com/Seldaek/monolog) |
| PSR-6 | 缓存 [psr/cache](https://github.com/php-fig/cache) | [tedivm/stash](https://github.com/tedious/Stash) 或 [psx/cache](https://github.com/apioo/psx-cache) |
| PSR-7 | HTTP消息 [psr/http-message](https://github.com/php-fig/http-message) | [guzzlehttp/psr7](https://github.com/guzzle/psr7) |
| PSR-11 | 容器 [psr/container](https://github.com/php-fig/container) | [league/container](https://github.com/thephpleague/container) |
| PSR-13 | 超媒体链接 [psr/link](https://github.com/php-fig/link) | [fig/link-util](https://github.com/php-fig/link-util) |
| PSR-14 | 事件分发 [psr/event-dispatcher](https://github.com/php-fig/event-dispatcher) | [crell/tukio](https://github.com/Crell/Tukio) |
| PSR-15 | HTTP请求处理器 [psr/http-server-handler](https://github.com/php-fig/http-server-handler) | [equip/dispatch](https://github.com/equip/dispatch) |
| PSR-15 | HTTP请求处理器 [psr/http-server-middleware](https://github.com/php-fig/http-server-middleware) | [middlewares/request-handler](https://github.com/middlewares/request-handler) |
| PSR-16 | 缓存 [psr/simple-cache](https://github.com/php-fig/simple-cache) | [psx/cache](https://github.com/apioo/psx-cache) |
| PSR-17 | HTTP工厂 [psr/http-factory](https://github.com/php-fig/http-factory) | [http-interop/http-factory-guzzle](https://github.com/http-interop/http-factory-guzzle) |
| PSR-18 | HTTP客户端 [psr/http-client](https://github.com/php-fig/http-client) | [ricardofiorani/guzzle-psr18-adapter](https://github.com/ricardofiorani/guzzle-psr18-adapter) |

# 2 设计

- 单入口 index.php, 由 `[Router](src/Component/Router.php)` 解析网址传递的参数找到相应的控制器
- 依赖注入容器 `[App](src/Container/App.php)` 目前是简单处理
- 配置不依赖于 php 文件, 只有一份在 .env 中

# 3 案例

## 3.1 商品秒杀

> [点击查看秒杀源码](./app/Logic/Spike.php)

### 3.1.1 问题及解决方案

- 多线程测试时会出现 (顾客买到数量 + 剩余量 > 总库存量) 的问题
    1. `简单处理` : `update table set inventory = inventory - {x} where id = {id}`
- 商品超卖, 使得数据库中某一商品变成负数, 解决方案如下
    1. `简单处理` : 库存字段设置成 unsigned 类型, 和事务一起使用
    1. `SQL 处理` : `update table set inventory = inventory - {x} where id = {id} and inventory >= {x}`
    1. `缓存/文件建锁` : 进入时加锁 `flock, $lock->lock()`, 完成后解锁 `fclose, $lock->unlock()`
    1. `Reids 辅助` : 使用事务(乐观锁)

```php
# 缓存/文件建锁思想
$lock = Lock::getInstance();
while (!$lock->isLock()) {
    // 这里加入次数限制或时间限制
    $lock->lock();
    // TODO
    $lock->unlock();
    break;
}
```

```php
# Reids 辅助
$numKey = 'test:spike:goods_num';
$redis = new Redis();
$redis->watch($numKey);
$num = $redis->get($numKey);
usleep(100); # 耗时操作
if ($num <= 0) {
    return;
}
$redis->multi();
$redis->decr($numKey);
$redis->exec();
```

## 3.2 一致性哈希算法

> [源代码](app/Distribute)
>
> [测试代码](tests/App/MemcachedTest.php), 使用 `distribute` 方法

## 3.3 令牌桶算法限流

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

## 3.4 Redis 特性

> 特性测试代码均在 [tests/App/RedisTest](tests/App/RedisTest.php) 中

- 发布订阅 : 推送使用 `publish` 方法, 接收使用 `subscribe` 方法
- GEO : 使用 `geo` 方法, 计算经纬度距离, 筛选经纬度范围坐标
- 位图 : 使用 `bitmap` 方法, 大量的 true/false 统计能节省不少空间, 但是比较少的数量建议不使用这种数据类型, 当然也可以使用更小的 hyperloglog
- hyperloglog : 使用 `hyper` 方法, 统计百万级的独立用户, 每天向内存中输入 1e6 的用户 ID, 可能只需几十 kb 的内存, 好用的东西不完美, 并不是 0 失误, 不能取出单条的数据
- pipeline : 使用 `pipeline` 方法, 节省大量时间, n 次命令的执行可能会有 n 次的网络传输, 放到 pipeline 中, 一次网络请求就可以执行多条命令(此时仍然是原子级别), 然后依次返回结果集, 注意 pipeline 携带的数据量, 每次只作用于一个 Redis 节点

## 3.5 消息队列

- amqp 和 php-libamqp 的性能比较, [建议在 cli 环境下执行](console/mq.php)
    - 保证结构一致且是空队列的情况. 十万级的数目, amqp 比 libamqp 的效率高 40% ~ 60%; 万级的数目, amqp 比 libamqp 的效率高 100% ~ 110%
    - [amqp 的源码](app/MQ/AmqpDemo.php) 和 [libamqp 的源码](app/MQ/LibMqDemo.php)


