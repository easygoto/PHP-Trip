<?php

namespace Trink\Frame\Controller;

use Trink\App\Trip\Logic\Spike;
use Trink\Frame\Component\BaseController;

class SpikeController extends BaseController
{
    public function mysql()
    {
        $userId = mt_rand(10000000, 99999999);
        $goodsTotal = rand(1, 5);
        $goodsList = [];
        $tempGoodsIdList = [];

        while (($goodsTotal--) > 0) {
            $tempGoodsIdList[] = mt_rand(1, 100);
        }
        $tempGoodsIdList = array_unique($tempGoodsIdList);
        foreach ($tempGoodsIdList as $goodsId) {
            $goodsList[] = ['goods_id' => $goodsId, 'goods_num' => mt_rand(1, 5)];
        }

        $result = Spike::mysql($userId, $goodsList);
        return $result->asJson();
    }
}
