<?php


namespace Trink\Dp\DependencyInjection\Company\Worker;

class Sales
{
    /** @var Technology */
    private $technology;

    public function __construct(Technology $technology)
    {
        $this->technology = $technology;
    }

    public function solveTechnologyQuestion()
    {
        $this->technology->solveTechnologyQuestion();
    }

    public function solveSalesQuestion()
    {
        print "我们是销售，销售对我们不是事儿!\n";
    }
}
