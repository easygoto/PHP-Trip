<?php

namespace spike\mysql;

require 'DB.php';
require 'Spike.php';

/**
 * Class SpikeTest
 */
class SpikeTest {

    /**
     * @param $user_total
     */
    public static function buy($user_total = 1000) {

        for ($i = 0; $i < $user_total; $i ++) {
            $user_id     = mt_rand(10000000, 99999999);
            $goods_list  = [];
            $goods_total = rand(1, 5);

            while (($goods_total --) > 0) {
                $goods_list[] = [
                    'goods_id'  => rand(1, 100),
                    'goods_num' => rand(1, 5),
                ];
            }

            $result = Spike::getInstance()->buy($user_id, $goods_list);
            echo "{$result['msg']}\n";
        }
    }
}

SpikeTest::buy();

