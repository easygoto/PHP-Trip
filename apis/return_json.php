<?php

// handle data
$headers = [];
foreach ($_SERVER as $key => $value) {
    if (substr($key, 0, 5) == 'HTTP_') {
        $key = strtolower(substr($key, 5));
        $headers[$key] = $value;
    }
}
$method = $_SERVER['REQUEST_METHOD'];
$response = json_encode([
    'method'  => $method,
    'request' => $_REQUEST,
    'input'   => json_decode(file_get_contents("php://input") ?? '', 1),
    'headers' => $headers,
]);

if (in_array($method, ['OPTION', 'HEAD']) && rand(0, 9) > 5) {
    header('HTTP/1.1 404 Not Found');
    exit;
}

// log
$filename = __DIR__ . '/debug/' . date('Y_m_d/H_i_s') . ".{$method}.log";
$dirname = dirname($filename);
if (!file_exists($dirname)) {
    mkdir($dirname, 0777, 1);
}
file_put_contents($filename, $response);

// return
header('Content-Type: application/json');
exit($response);
