<?php

namespace Test\Trip\Dp;

use Test\Trip\TestCase;
use Trink\Dp\Strategy\Demo\MarkLogicMarker;
use Trink\Dp\Strategy\Demo\MatchMarker;
use Trink\Dp\Strategy\Demo\RegexMarker;
use Trink\Dp\Strategy\Demo\TextQuestion;

class StrategyTest extends TestCase
{
    public function testStrategyDemo()
    {
        $markers = [
            new RegexMarker("/f.ve/"),
            new MatchMarker("five"),
            new MarkLogicMarker('$input equals "five"'),
        ];
        foreach ($markers as $marker) {
            print get_class($marker) . "\n";
            $question = new TextQuestion("how many beans make five", $marker);
            foreach (['five', 'four'] as $response) {
                print "\tresponse: $response: ";
                if ($question->mark($response)) {
                    print "well done\n";
                } else {
                    print "never mind\n";
                }
            }
        }
        $this->assertTrue(true);
    }
}
