<?php


namespace Tests\Dp\App;

use PHPUnit\Framework\TestCase;
use Trink\Trip\App\Dota\Hero\Axe;
use Trink\Trip\App\Dota\Hero\Sven;
use Trink\Trip\App\Dota\Skill\Real\StormHammer;

class BaseTest extends TestCase
{
    /**
     * @test
     * 斧王和斯温之间的爱恨纠缠
     */
    public function axeAndSven()
    {
        $axe = (new Axe())
            ->setMagicValue(100)
            ->setLifeValue(600);
        $sven = (new Sven())
            ->setLifeValue(800)
            ->setMagicValue(400);
        $stormHammer = new StormHammer;
        $stormHammer->setCostMagic(150);
        $stormHammer->setDizzinessTime(2);
        $stormHammer->setHurtValue(200);
        $sven->addSkill($stormHammer);

        print "斧王血量 : {$axe->getLifeValue()}\n";
        print "斧王魔法量 : {$axe->getMagicValue()}\n";
        print "斧王状态 : {$axe->getStatus()}\n";
        print "斯温血量 : {$sven->getLifeValue()}\n";
        print "斯温魔法量 : {$sven->getMagicValue()}\n";
        print "斯温状态 : {$sven->getStatus()}\n";

        print str_repeat('=', 30) . "\n";
        $sven->castSKill2Hero(0, $axe);

        print "斧王血量 : {$axe->getLifeValue()}\n";
        print "斧王魔法量 : {$axe->getMagicValue()}\n";
        print "斧王状态 : {$axe->getStatus()}\n";
        print "斯温血量 : {$sven->getLifeValue()}\n";
        print "斯温魔法量 : {$sven->getMagicValue()}\n";
        print "斯温状态 : {$sven->getStatus()}\n";

        $this->assertTrue(true);
    }
}
