<?php

use Trink\Strategy\Demo\MarkLogicMarker;
use Trink\Strategy\Demo\MatchMarker;
use Trink\Strategy\Demo\RegexMarker;
use Trink\Strategy\Demo\TextQuestion;

require_once '../vendor/autoload.php';

$markers = [
    new RegexMarker("/f.ve/"),
    new MatchMarker("five"),
    new MarkLogicMarker('$input equals "five"'),
];
foreach ($markers as $marker) {
    print get_class($marker)."\n";
    $question = new TextQuestion("how many beans make five", $marker);
    foreach (['five','four'] as $response){
        print "\tresponse: $response: ";
        if ($question->mark($response)){
            print "well done\n";
        } else {
            print "never mind\n";
        }
    }
}