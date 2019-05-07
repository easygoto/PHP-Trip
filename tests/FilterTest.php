<?php


namespace Dp\Test;

use PHPUnit\Framework\TestCase;
use Trink\Dp\Filter\Workflow\CEO;
use Trink\Dp\Filter\Workflow\Director;
use Trink\Dp\Filter\Workflow\Leader;
use Trink\Dp\Filter\Workflow\Leave;
use Trink\Dp\Filter\Workflow\Manager;

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
