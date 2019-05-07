<?php


namespace Tests\Dp;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Filter\Workflow\Process\Leave;
use Trink\Dp\Filter\Workflow\Worker\CEO;
use Trink\Dp\Filter\Workflow\Worker\Director;
use Trink\Dp\Filter\Workflow\Worker\Leader;
use Trink\Dp\Filter\Workflow\Worker\Manager;

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
