<?php


namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\App\Dp\DependencyInjection\Company\Dream;
use Trink\App\Dp\DependencyInjection\Demo\App;

class DependencyInjectionTest extends TestCase
{
    public function test()
    {
        $app = App::instance();

        $db = $app->db;
        $db->test();

        $log = $app->log;
        $log->test();

        $config = $app->config;
        $config->test();

        $this->assertTrue(true);
    }

    /** @test */
    public function dreamCompany()
    {
        $dreamCompany    = Dream::instance();
        $sales           = $dreamCompany->sales;
        $customerService = $dreamCompany->customerService;

        $sales->solveSalesQuestion();
        $sales->solveTechnologyQuestion();

        $customerService->solveTechnologyQuestion();
        $customerService->solveCustomerServiceQuestion();

        $this->assertTrue(true);
    }
}
