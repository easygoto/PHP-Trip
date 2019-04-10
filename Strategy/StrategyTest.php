<?php

use Strategy\Demo\MarkLogicMarker;
use Strategy\Demo\MatchMarker;
use Strategy\Demo\RegexMarker;
use Strategy\Demo\TextQuestion;

require_once '../autoload.php';

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