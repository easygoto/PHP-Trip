<?php


namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\Filter\Workflow\Process\Leave;
use Trink\App\Dp\Filter\Workflow\Worker\CEO;
use Trink\App\Dp\Filter\Workflow\Worker\Director;
use Trink\App\Dp\Filter\Workflow\Worker\Leader;
use Trink\App\Dp\Filter\Workflow\Worker\Manager;

class FilterTest extends TestCase
{
    /** @test */
    public function work()
    {
        $leave = (new Leave)->setDays(5)->addWorker([
            Leader::class,
            Director::class,
            Manager::class,
            CEO::class,
        ])->exec();
        $this->assertTrue($leave instanceof Leave);
    }
}
