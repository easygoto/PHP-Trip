<?php

// 预期队列的空满状态可以通过更改 chan 中的 size 来实现
Co\run(
    function () {
        global $inQueue, $outQueue;
        $inQueue = [];
        $outQueue = [];
        $chan = new chan(10);
        go(
            function () use ($chan) {
                for ($i = 0; $i < 10; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-1: {$i}";
                    $chan->push(['index' => "chan-1: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.2);
                }
            }
        );
        go(
            function () use ($chan) {
                for ($i = 0; $i < 20; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-2: {$i}";
                    $chan->push(['index' => "chan-2: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.1);
                }
            }
        );
        go(
            function () use ($chan) {
                for ($i = 0; $i < 15; $i++) {
                    global $inQueue;
                    $inQueue[] = "chan-3: {$i}";
                    $chan->push(['index' => "chan-3: {$i}", 'rand' => mt_rand(1e10, 1e11 - 1)]);
                    co::sleep(0.15);
                }
            }
        );

        go(
            function () use ($chan) {
                while (true) {
                    global $outQueue;
                    $data = $chan->pop();
                    $outQueue[] = $data['index'] ?? '-';
                    co::sleep(0.2);
                    echo json_encode(['length' => $chan->length(), 'data' => $data]) . "\n";
                }
            }
        );
        go(
            function () use ($chan) {
                while (true) {
                    global $outQueue;
                    $data = $chan->pop();
                    $outQueue[] = $data['index'] ?? '-';
                    co::sleep(0.3);
                    echo json_encode(['length' => $chan->length(), 'data' => $data]) . "\n";
                }
            }
        );
    }
);

global $inQueue, $outQueue;
echo json_encode($inQueue) . "\n";
echo json_encode($outQueue) . "\n";
