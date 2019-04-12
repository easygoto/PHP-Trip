<?php


namespace Trink\Strategy\Demo;


abstract class Question {
    protected $prompt;
    protected $marker;

    function __construct($prompt, Marker $marker) {
        $this->marker = $marker;
        $this->prompt = $prompt;
    }

    function mark($response) {
        return $this->marker->mark($response);
    }
}
