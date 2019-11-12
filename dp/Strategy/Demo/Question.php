<?php


namespace Trink\App\Dp\Strategy\Demo;

abstract class Question
{
    protected $prompt;
    protected $marker;

    public function __construct($prompt, Marker $marker)
    {
        $this->marker = $marker;
        $this->prompt = $prompt;
    }

    public function mark($response)
    {
        return $this->marker->mark($response);
    }
}
