<?php


namespace Trink\Trip\App\Logic;

use Exception;
use Trink\Core\Container\App;
use Trink\Core\Helper\Arrays;
use Trink\Core\Helper\Result;

class Spike
{
    /**
     * mysql 版的秒杀
     *
     * @param int   $uid
     * @param array $goodsOrder
     *
     * @return array
     */
    public static function mysql(int $uid, array $goodsOrder = [])
    {
        $db = App::instance()->capsule;
        // 1、校验订单
        if (!is_array($goodsOrder) || empty($goodsOrder)) {
            return Result::fail('非正常订单(1)', ['order' => $goodsOrder])->asArray();
        }

        $checkResult = [];
        foreach ($goodsOrder as $aGoods) {
            $goodsId  = Arrays::getInt($aGoods, 'goods_id');
            $goodsNum = Arrays::getInt($aGoods, 'goods_num');

            if ($goodsId <= 0) {
                $checkResult[$goodsId][] = "goods id is {$goodsId}";
            }
            if ($goodsNum <= 0) {
                $checkResult[$goodsId][] = "goods num is {$goodsNum}";
            }
        }
        if (!empty($checkResult)) {
            return Result::fail('非正常订单(2)', ['check' => $checkResult])->asArray();
        }

        $goodsIdNumList = array_column($goodsOrder, 'goods_num', 'goods_id');
        if (count($goodsIdNumList) != count($goodsOrder)) {
            return Result::fail('非正常订单(3)')->asArray();
        }

        $messageList = [];
        try {
            $db->beginTransaction();

            // 2、取出当前订单信息，进一步判断库存
            $goodsList = $db->table('goods')
                ->whereIn('id', array_keys($goodsIdNumList))
                ->where('status', '=', 1)
                ->where('is_delete', '=', 0)
                ->get()->toArray();

            if ((count($goodsIdNumList) != count($goodsList))) {
                throw new Exception('秒杀失败，商品出错');
            }

            foreach ($goodsList as $key => $goods) {
                $goodsId   = Arrays::getInt($goods, 'id');
                $goodsName = Arrays::get($goods, 'name', '未知商品');
                $goodsNum  = $goodsIdNumList[$goodsId];

                // 将订单中的 num 加到数组中，之后加减库存时需要用到
                if (is_array($goodsList[$key])) {
                    $goodsList[$key]['goods_num'] = $goodsNum;
                } elseif (is_object($goodsList[$key])) {
                    $goodsList[$key]->goods_num = $goodsNum;
                } else {
                    $messageList[$goodsId] = '商品异常';
                }

                if (Arrays::getInt($goods, 'inventory') < $goodsNum) {
                    $messageList[$goodsId] = $goodsName . '库存不足';
                }
            }
            if (!empty($messageList)) {
                throw new Exception('秒杀失败，库存不足');
            }

            // 3、秒杀成功，把信息加到 order 和 order_goods 中
            $nowTime    = date('Y-m-d H:i:s');
            $orderSn    = date('YmdHis') . mt_rand(10000000, 99999999);
            $totalPrice = number_format(array_reduce($goodsList, function ($result, $goods) {
                return (float)$result +
                    Arrays::getDigits($goods, 'selling_price') *
                    Arrays::getInt($goods, 'goods_num');
            }), 2);

            $orderId = $db->table('order')
                ->insertGetId([
                    'uid'         => (int)$uid,
                    'order_sn'    => $orderSn,
                    'total_price' => (float)$totalPrice,
                    'created_at'  => $nowTime,
                    'updated_at'  => $nowTime,
                    'operated_at' => $nowTime,
                    'status'      => 1,
                    'is_delete'   => 0,
                ]);
            if (!$orderId) {
                throw new Exception('订单添加失败');
            }

            $currentGoodsList = [];
            foreach ($goodsList as $key => $goods) {
                $currentGoodsList[] = [
                    'order_id'      => (int)$orderId,
                    'goods_id'      => Arrays::getInt($goods, 'id'),
                    'goods_name'    => Arrays::get($goods, 'name'),
                    'wholesale'     => Arrays::getDigits($goods, 'wholesale'),
                    'selling_price' => Arrays::getDigits($goods, 'selling_price'),
                    'market_price'  => Arrays::getDigits($goods, 'market_price'),
                    'goods_num'     => Arrays::getInt($goods, 'goods_num'),
                ];
            }
            if (!$db->table('order_goods')->insert($currentGoodsList)) {
                throw new Exception('订单商品添加失败');
            };

            // 4、商品表减去相应的库存
            foreach ($goodsList as $goods) {
                if (!$db->table('goods')
                    ->where('id', '=', Arrays::getInt($goods, 'id'))
                    ->decrement('inventory', Arrays::getInt($goods, 'goods_num'))
                ) {
                    throw new Exception('商品库存更新失败');
                }
            }

            $db->commit();
            return Result::success([], '秒杀成功')->asArray();
        } catch (Exception $e) {
            try {
                $db->rollBack();
            } catch (Exception $e) {
            }
            return Result::fail($e->getMessage(), ['message' => $messageList])->asArray();
        }
    }
}
