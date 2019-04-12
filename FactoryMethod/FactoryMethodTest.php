<?php

use FactoryMethod\Demo\BloggsCommsManager;

require_once '../vendor/autoload.php';

$bcm = new BloggsCommsManager();
echo $bcm->getHeaderText();
var_dump($bcm->getApptEncoder());
echo $bcm->getFooterText();