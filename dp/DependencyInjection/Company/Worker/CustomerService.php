<?php


namespace Trink\App\Dp\DependencyInjection\Company\Worker;

class CustomerService
{
    /** @var Technology */
    private $technology;

    public function __construct(Technology $technology)
    {
        $this->technology = $technology;
    }

    public function solveCustomerServiceQuestion()
    {
        print "我们是客服，我们的服务只为让您满意!\n";
    }

    public function solveTechnologyQuestion()
    {
        $this->technology->solveTechnologyQuestion();
    }
}
