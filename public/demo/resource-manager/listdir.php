<?php

$current_path = (isset($_POST['path']) && !empty($_POST['path'])) ? $_POST['path'] : [];
$current_path = implode('/', $current_path);

$path = 'C:/'.$current_path;
$data = [];
if (is_dir($path)) {
    $dir = opendir($path);
    while (($row = readdir($dir)) != false) {
        if ($row == '.' || $row == '..') {
            continue ;
        }
        $current_file = $path.'/'.$row;
        $data[] = [
            'id' => uniqid(rand(0,999)),
            'name' => $row,
            'dir' => is_dir($current_file),
            'file' => is_file($current_file),
            'readable' => is_readable($current_file),
        ];
    }
    closedir($dir);

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    header('Content-Type: application/json');
    echo json_encode([]);
}

