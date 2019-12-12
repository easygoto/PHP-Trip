### HTTP

#### 简短介绍

##### 报文

```http request
GET /test-http/apis/return_json.php HTTP/1.1
Host: 192.168.0.173


```

##### 请求方法

|方法|意义|
|---|---|
|GET|获取|
|POST|添加|
|PUT|修改|
|PATCH|扩展的PUT,用来修改部分|
|DELETE|删除|
|HEAD|不接收响应体|
|OPTIONS|查看支持方法|

##### nginx 防治措施

```
server {
    listen 80;
    server_name localhost;
    root /var/www/html;
    index index.php index.html;

    if ($request_method !~* GET|POST|PUT|PATCH|DELETE|HEAD) {
        return 403;
    }

    location ~ \.php$ {
        fastcgi_pass   php740:9000;
        include        fastcgi_params;
        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

##### PHP 防治措施

```php
<?php

$method = $_SERVER['REQUEST_METHOD'];
if (!in_array($method, ['GET','POST','PUT','PATCH','DELETE','HEAD'])) {
    header('HTTP/1.1 403 Forbidden');
    exit;
}

```

#### 实现方法

##### ide

> 创建 *.http 文件

```http request
HEAD /test-http/apis/return_json.php HTTP/1.1
Host: 192.168.0.173


###

GET /test-http/apis/return_json.php?name=name HTTP/1.1
Host: 192.168.0.173


###

POST /test-http/apis/return_json.php HTTP/1.1
Host: 192.168.0.173
Content-Type: application/json

{"name": "name"}
###
```

##### curl

```php
<?php

// example head
$ch = curl_init('192.168.0.173/test-http/apis/return_json.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'HEAD');
curl_setopt($ch, CURLOPT_HEADER, 1); // 返回头
curl_setopt($ch, CURLOPT_NOBODY, 1); // 无返回
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $res, $httpCode;

// example post
$ch = curl_init($this->returnJsonUrl());
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['name' => 'name']));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json', 'Authorization: ' . md5(microtime())]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$res = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
echo $res, $httpCode;
```

##### socket



##### stream


