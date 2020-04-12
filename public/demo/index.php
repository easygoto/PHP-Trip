<?php

$dir = opendir('./');
$demoList = [];
while (($demo = readdir($dir)) != false) {
    if (is_dir($demo) && $demo[0] != '.') {
        $demoList[] = $demo;
    }
}
closedir($dir);

?>

<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .project-demo {
            float: left;
            height: 40px;
            width: 300px;
            margin: 10px;
            padding: 0 20px;
            line-height: 40px;
            background-color: #99D6F3;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<?php foreach ($demoList as $demo) : ?>
    <a href="<?= $demo ?>">
        <div class="project-demo"><?= $demo ?></div>
    </a>
<?php endforeach; ?>
</body>
</html>
