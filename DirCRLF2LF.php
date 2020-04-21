<?php

function fileList(string $dirPath, $exclude = [])
{
    $pathList = [];
    foreach (scandir($dirPath) as $path) {
        if (in_array($path, array_merge(['.', '..'], $exclude))) {
            continue;
        }
        if (!in_array(substr($path, -3), ['php', '.js', 'tml'])) {
            continue;
        }
        if (is_dir($dirPath . '/' . $path)) {
            $pathList = array_merge($pathList, fileList($dirPath . '/' . $path, $exclude));
        } else {
            $pathList[] = $dirPath . '/' . $path;
        }
    }
    return $pathList;
}

$filePathList = fileList(__DIR__, ['.git', '.idea', 'vendor', 'data']);
foreach ($filePathList as $filePath) {
    file_put_contents(
        $filePath,
        str_replace(
            "\r\n",
            "\n",
            file_get_contents($filePath)
        )
    );
}
