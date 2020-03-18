<?php

/*
 * main start
 * co1.1 start
 * co2.1 start
 * Obj::test: ffa5c0b868f9dd5a20cba9408dc1f87e
 * Obj::test: 85dd59ea30935b3391ea4d39c08dbaf4
 * Obj::test: f5cf149fdb8cc558469e17d03a8984dd
 * main end
 * [[1,-1],[2,1],[3,-1],[4,-1],[5,-1],[6,-1],[7,-1],[8,-1]] // co3.1 co2.2 在此后才开始, 所以没有统计上
 * 0. test: 32227d69e8c63c4883baa62733b44b13
 * co3.1 start
 * co2.1 end
 * 1. test: 5d77a50d3a327c0096300c643a740ce4
 * co2.2 start
 * 2. test: 3ecd1877a7d3e4d7b21845722fc22554
 * co1.1 end
 * co1.1 close and db close
 * co3.1 end
 * co2.2 end
 */

class Obj
{
    public function test($i)
    {
        global $cidList;
        $cidList[] = [co::getCid(), co::getPcid()];
        echo __METHOD__ . ": {$i}\n";
    }
}

function test($i, $j)
{
    global $cidList;
    $cidList[] = [co::getCid(), co::getPcid()];
    co::sleep($i / 5 + .001);
    echo "{$i}. " . __FUNCTION__ . ": {$j}\n";
}

echo "main start\n";
global $cidList;
$cidList = [];

go(
    function () {
        global $cidList;
        $cidList[] = [co::getCid(), co::getPcid()];
        echo "co1.1 start\n";
        defer(function () {
            echo "co1.1 close and db close\n";
        });
        go(
            function () {
                global $cidList;
                $cidList[] = [co::getCid(), co::getPcid()];
                echo "co2.1 start\n";
                co::sleep(.2);
                go(
                    function () {
                        global $cidList;
                        $cidList[] = [co::getCid(), co::getPcid()];
                        echo "co3.1 start\n";
                        co::sleep(.5);
                        echo "co3.1 end\n";
                    }
                );
                echo "co2.1 end\n";
            }
        );
        co::sleep(.3);
        go(
            function () {
                global $cidList;
                $cidList[] = [co::getCid(), co::getPcid()];
                echo "co2.2 start\n";
                co::sleep(.4);
                echo "co2.2 end\n";
            }
        );
        co::sleep(.1);
        echo "co1.1 end\n";
    }
);

for ($i = 0; $i < 3; $i++) {
    // go 等同于 co::create
    co::create('test', $i, md5(uniqid(microtime())));
    go([new Obj(), 'test'], md5(uniqid(microtime())));
}

echo "main end\n";
echo json_encode($cidList) . "\n";
