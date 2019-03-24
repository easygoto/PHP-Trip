<?php

include 'Template.php';
$tpl = new Template(['php_turn' => true, 'debug' => true]);
$tpl->assign('data', 'hello world');
$tpl->assign('person', 'cafeCAT');
$tpl->assign('pai', 3.14);
$arr = [1, 2, 3, 4, "hahattt", 6];
$tpl->assign('b', $arr);
$tpl->show('member');
