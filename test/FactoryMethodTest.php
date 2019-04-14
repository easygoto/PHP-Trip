<?php

use PHPUnit\Framework\TestCase;
use Trink\FactoryMethod\Demo\BloggsCommsManager;

require_once '../vendor/autoload.php';

class FactoryMethodTest extends TestCase {

    public function testDemo() {
        $bcm = new BloggsCommsManager();
        echo $bcm->getHeaderText();
        var_dump($bcm->getApptEncoder());
        echo $bcm->getFooterText();
    }
}