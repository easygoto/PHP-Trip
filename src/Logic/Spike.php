<?php


namespace Trink\Demo\Logic;

use Exception;
use Trink\Demo\Helper\ArrayHelper;
use Trink\Demo\Helper\ReturnHelper;
use Trink\Demo\Lib\DB;

class Spike
{
    /**
     * mysql 版的秒杀
     *
     * @param int   $uid
     * @param array $goods_order
     *
     * @return array
     */
    public static function mysql(int $uid, array $goods_order = [])
    {
        $db = DB::instance();
        // 1、校验订单
        if (!is_array($goods_order) || empty($goods_order)) {
            return ReturnHelper::fail('非正常订单(1)', ['order' => $goods_order])->asArray();
        }

        $check_result = [];
        foreach ($goods_order as $a_goods) {
            $goods_id  = ArrayHelper::getInteger($a_goods, 'goods_id');
            $goods_num = ArrayHelper::getInteger($a_goods, 'goods_num');

            if ($goods_id <= 0) {
                $check_result[$goods_id][] = "goods id is {$goods_id}";
            }
            if ($goods_num <= 0) {
                $check_result[$goods_id][] = "goods num is {$goods_num}";
            }
        }
        if (!empty($check_result)) {
            return ReturnHelper::fail('非正常订单(2)', ['check' => $check_result])->asArray();
        }

        $goods_id_num_list = array_column($goods_order, 'goods_num', 'goods_id');
        if (count($goods_id_num_list) != count($goods_order)) {
            return ReturnHelper::fail('非正常订单(3)')->asArray();
        }

        if (!$db->pdo->beginTransaction()) {
            return ReturnHelper::fail('系统维护中...')->asArray();
        }

        $message_list = [];
        try {
            // 2、取出当前订单信息，进一步判断库存
            $goods_list = $db->select('goods', '*', [
                'id'        => array_keys($goods_id_num_list),
                'status'    => 1,
                'is_delete' => 0,
            ]);

            if ((count($goods_id_num_list) != count($goods_list))) {
                throw new Exception('秒杀失败，商品出错');
            }

            foreach ($goods_list as $key => $goods) {
                $goods_id   = ArrayHelper::getInteger($goods, 'id');
                $goods_name = ArrayHelper::getValue($goods, 'name', '未知商品');
                $goods_num  = $goods_id_num_list[$goods_id];

                // 将订单中的 num 加到数组中，之后加减库存时需要用到
                $goods_list[$key]['goods_num'] = $goods_num;

                if (ArrayHelper::getInteger($goods, 'inventory') < $goods_num) {
                    $message_list[$goods_id] = $goods_name . '库存不足';
                }
            }
            if (!empty($message_list)) {
                throw new Exception('秒杀失败，库存不足');
            }

            // 3、秒杀成功，把信息加到 order 和 order_goods 中
            $now_time    = date('Y-m-d H:i:s');
            $order_sn    = date('YmdHis') . mt_rand(10000000, 99999999);
            $total_price = number_format(array_reduce($goods_list, function ($result, $goods) {
                return (float)$result + (float)$goods['selling_price'] * (int)$goods['goods_num'];
            }), 2);

            $order_insert_result = $db->insert('order', [
                'uid'         => (int)$uid,
                'order_sn'    => $order_sn,
                'total_price' => (float)$total_price,
                'created_at'  => $now_time,
                'updated_at'  => $now_time,
                'operated_at' => $now_time,
                'status'      => 1,
                'is_delete'   => 0,
            ]);
            if (!$order_insert_result) {
                throw new Exception('订单添加失败');
            }
            $order_id = $db->id();

            foreach ($goods_list as $key => $goods) {
                if (!$db->insert('order_goods', [
                    'order_id'      => (int)$order_id,
                    'goods_id'      => (int)$goods['id'],
                    'goods_name'    => $goods['name'],
                    'wholesale'     => (float)$goods['wholesale'],
                    'selling_price' => (float)$goods['selling_price'],
                    'market_price'  => (float)$goods['market_price'],
                    'goods_num'     => (int)$goods['goods_num'],
                ])) {
                    throw new Exception('订单商品添加失败');
                };
            }

            // 4、商品表减去相应的库存
            foreach ($goods_list as $goods) {
                if (!$db->update('goods', [
                    'inventory[-]' => (int)$goods['goods_num'],
                ], [
                    'id' => (int)$goods['id'],
                ])) {
                    throw new Exception('商品库存更新失败');
                }
            }

            $db->pdo->commit();
            return ReturnHelper::success([], '秒杀成功')->asArray();
        } catch (Exception $e) {
            $db->pdo->rollBack();
            return ReturnHelper::fail($e->getMessage(), ['message' => $message_list])->asArray();
        }
    }
}
