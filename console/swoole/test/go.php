<?php

/*
 * main start
 * co-1 start
 * co-1.1 start
 * co-2 start
 * co-3 start
 * Obj::test: 3857870d24cef1d56e3f7d33db87efca: 1b67e181fbe59f93c092a24cde107d39
 * Obj::test: 01bff6f459e2c02168e010612bb102a0: 6e67c633b3b63b6aa92763e767c53d92
 * Obj::test: bd8f66c0681b9c4d7887558bca794c15: e0aa02ade4c4173ef18c9f654e606f30
 * main end
 * {"0":9,"1":2,"2":1,"3":3,"4":4,"5":5,"6":7} // 保存了当前正在运行的协程
 * [[1,-1],[2,1],[3,-1],[4,-1],[5,-1],[6,-1],[7,-1],[8,-1],[9,-1],[10,-1]] // co-1.1.1 co-1.2 在此后才开始, 所以没有统计上
 * 0. test: 920c2165487233f0cae8a99bc8c18621
 * co-1.1.1 start
 * co-1.1 end
 * 1. test: 9f276834a68f9482b8c8c0a63ac45201
 * co-1.2 start
 * co-1 end
 * co-1 close and db close
 * 2. test: dec943e9decfc36d91f9e47022426630
 * co-2 end
 * co-3 end
 * co-1.1.1 end
 * co-1.2 end
 */

class Obj
{
    private string $id = '';

    public function __construct()
    {
        $this->id = md5(uniqid(rand(1e10, 1e11 - 1) . microtime()));
    }

    public function test($i)
    {
        global $cidList;
        $cidList[] = [co::getCid(), co::getPcid()];
        echo __METHOD__ . ": {$i}: {$this->id}\n";
    }
}

function test($i, $j)
{
    global $cidList;
    $cidList[] = [co::getCid(), co::getPcid()];
    co::sleep($i / 5 + .001);
    echo "{$i}. " . __FUNCTION__ . ": {$j}\n";
}

Co\run(function () {
    echo "main start\n";
    global $cidList;
    $cidList = [];

    go(
        function () {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-1 start\n";
            defer(
                function () {
                    echo "co-1 close and db close\n";
                }
            );
            go(
                function () {
                    global $cidList;
                    $cidList[] = [co::getCid(), co::getPcid()];
                    echo "co-1.1 start\n";
                    co::sleep(.2);
                    go(
                        function () {
                            global $cidList;
                            $cidList[] = [co::getCid(), co::getPcid()];
                            echo "co-1.1.1 start\n";
                            co::sleep(.5);
                            echo "co-1.1.1 end\n";
                        }
                    );
                    echo "co-1.1 end\n";
                }
            );
            co::sleep(.3);
            go(
                function () {
                    global $cidList;
                    $cidList[] = [co::getCid(), co::getPcid()];
                    echo "co-1.2 start\n";
                    co::sleep(.4);
                    echo "co-1.2 end\n";
                }
            );
            co::sleep(.1);
            echo "co-1 end\n";
        }
    );

    $cid = go(
        function () {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-2 start\n";
            co::yield();
            echo "co-2 end\n";
        }
    );

    go(
        function () use ($cid) {
            global $cidList;
            $cidList[] = [co::getCid(), co::getPcid()];
            echo "co-3 start\n";
            co::sleep(0.5);
            co::resume($cid);
            echo "co-3 end\n";
        }
    );

    for ($i = 0; $i < 3; $i++) {
        // go 等同于 co::create
        co::create('test', $i, md5(uniqid(microtime())));
        go([new Obj(), 'test'], md5(uniqid(microtime())));
    }

    echo "main end\n";
    echo json_encode(co::listCoroutines()) . "\n";
    echo json_encode($cidList) . "\n";
});
