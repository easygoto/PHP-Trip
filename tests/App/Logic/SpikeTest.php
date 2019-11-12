<?php


namespace Test\Trip\App\Logic;

use Test\Trip\TestCase;
use Trink\App\Trip\Logic\Spike;

class SpikeTest extends TestCase
{
    /** @test */
    public function mysql()
    {
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
        $this->assertTrue(true);
    }
}
