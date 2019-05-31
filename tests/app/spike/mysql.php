<?php

use Trink\Trip\App\Spike;

require_once dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

for ($i = 0; $i < 100; $i ++) {
    $user_id     = mt_rand(10000000, 99999999);
    $goods_list  = [];
    $goods_total = rand(1, 5);

    while (($goods_total --) > 0) {
        $goods_list[] = [
            'goods_id'  => mt_rand(1, 100),
            'goods_num' => mt_rand(1, 5),
        ];
    }

    $result = Spike::mysql($user_id, $goods_list);
    echo "{$result['msg']}\n";
}
