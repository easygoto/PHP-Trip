<?php
/**
 * Created by PhpStorm.
 * User: LiJian
 * Date: 2019/3/23
 * Time: 19:55
 */

namespace spike\mysql;

use Exception;
use PDO;

/**
 * Class Spike
 *
 * @package spike\mysql
 */
class Spike {

    /**
     * @var $db PDO
     */
    private $db = null;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    /**
     * @param int   $uid
     * @param array $goods_order
     *
     * @return array
     */
    public function buy(int $uid, $goods_order = []) {
        // 1、校验订单
        if (! is_array($goods_order) || empty($goods_order)) {
            return $this->_result(0, '非正常订单(1)');
        }

        foreach ($goods_order as $goods_one) {
            $goods_id  = $this->_getValue($goods_one, 'goods_id');
            $goods_num = $this->_getValue($goods_one, 'goods_num');

            if (! is_numeric($goods_id) || $goods_id <= 0) {
                return $this->_result(0, '非正常订单(2)');
            }
            if (! is_numeric($goods_num) || $goods_num <= 0) {
                return $this->_result(0, '非正常订单(3)');
            }
        }

        if (! $this->db->beginTransaction()) {
            return $this->_result(0, '系统维护中...');
        }

        $message_list = [];
        try {
            // 2、取出当前订单信息，进一步判断库存
            $goods_id_num_list = array_column($goods_order, 'goods_num', 'goods_id');
            $goods_id_str      = implode(',', array_column($goods_order, 'goods_id'));

            $sql  = "select * from `goods` where `id` in (:goods_id_str)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':goods_id_str' => $goods_id_str,
            ]);
            $goods_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt->closeCursor();

            foreach ($goods_list as $key => $goods) {
                $goods_id   = $this->_getValue($goods, 'id');
                $goods_name = $this->_getValue($goods, 'name', '未知商品');
                $goods_num  = $goods_id_num_list[$goods_id];

                $goods_list[$key]['goods_num'] = $goods_num;

                if (! $this->_getValue($goods, 'inventory') || $goods['inventory'] < $goods_num) {
                    $message_list[$goods_id] = $goods_name . '库存不够';
                    continue;
                }
            }

            if (! empty($message_list)) {
                throw new Exception('秒杀失败');
            }

            // 3、秒杀成功，把信息加到 order 和 order_goods 中
            $order_sql   = 'insert into `order` (`uid`, `order_sn`, `total_price`, `created_at`, `updated_at`, `operated_at`, `status`, `is_delete`) values (:uid, :order_sn, :total_price, :created_at, :updated_at, :operated_at, :status, :is_delete)';
            $order_stmt  = $this->db->prepare($order_sql);
            $now_time    = date('Y-m-d H:i:s');
            $order_sn    = date('YmdHis') . mt_rand(10000000, 99999999);
            $total_price = 0;
            array_map(function ($goods) use (& $total_price) {
                $total_price += round(floatval($goods['selling_price']) * floatval($goods['goods_num']), 2);
            }, $goods_list);

            $order_stmt->bindValue(':uid', $uid);
            $order_stmt->bindValue(':order_sn', $order_sn);
            $order_stmt->bindValue(':total_price', $total_price);
            $order_stmt->bindValue(':created_at', $now_time);
            $order_stmt->bindValue(':updated_at', $now_time);
            $order_stmt->bindValue(':operated_at', $now_time);
            $order_stmt->bindValue(':status', 1);
            $order_stmt->bindValue(':is_delete', 0);
            $order_stmt_result = $order_stmt->execute();
            $order_stmt->closeCursor();
            if (! $order_stmt_result) {
                throw new Exception('订单添加失败');
            }
            $order_id = $this->db->lastInsertId();

            $order_goods_sql = 'insert into `order_goods` (`order_id`, `goods_id`, `goods_name`, `wholesale`, `selling_price`, `market_price`, `goods_num`) values ';
            foreach ($goods_list as $key => $goods) {
                $order_goods_sql .= " (:order_id_{$key}, :goods_id_{$key}, :goods_name_{$key}, :wholesale_{$key}, :selling_price_{$key}, :market_price_{$key}, :goods_num_{$key}), ";
            }
            $order_goods_sql = rtrim($order_goods_sql, ', ');

            $order_goods_stmt = $this->db->prepare($order_goods_sql);
            foreach ($goods_list as $key => $goods) {
                $order_goods_stmt->bindValue(":order_id_{$key}", $order_id);
                $order_goods_stmt->bindValue(":goods_id_{$key}", $goods['id']);
                $order_goods_stmt->bindValue(":goods_name_{$key}", $goods['name']);
                $order_goods_stmt->bindValue(":wholesale_{$key}", $goods['wholesale']);
                $order_goods_stmt->bindValue(":selling_price_{$key}", $goods['selling_price']);
                $order_goods_stmt->bindValue(":market_price_{$key}", $goods['market_price']);
                $order_goods_stmt->bindValue(":goods_num_{$key}", $goods['goods_num']);
            }

            $order_goods_stmt_result = $order_goods_stmt->execute();
            $order_goods_stmt->closeCursor();
            if (! $order_goods_stmt_result) {
                throw new Exception('订单商品添加失败');
            }

            // 4、商品表减去相应的库存
            $goods_sql = 'update `goods` set inventory = :inventory where id = :id';
            foreach ($goods_list as $goods) {
                $goods_stmt = $this->db->prepare($goods_sql);
                $inventory  = $goods['inventory'] - $goods['goods_num'];
                $goods_stmt_result = $goods_stmt->execute([
                    ':inventory' => $inventory,
                    ':id' => $goods['id'],
                ]);
                $goods_stmt->closeCursor();
                if (! $goods_stmt_result) {
                    throw new Exception('商品库存更新失败');
                }
            }

            $this->db->commit();
            return $this->_result(1, '秒杀成功');
        } catch (Exception $exception) {

            $this->db->rollBack();
            return $this->_result(0, $exception->getMessage(), $message_list);
        }
    }

    /**
     * @param        $list
     * @param        $key
     * @param string $default
     *
     * @return null
     */
    private function _getValue($list, $key, $default = '') {
        if (! array_key_exists($key, $list)) {
            return $default;
        }
        return $list[$key];
    }

    /**
     * @param int    $success
     * @param string $message
     * @param array  $data
     *
     * @return array
     */
    private function _result($success = 0, $message = '', $data = []) {
        return [
            'success' => $success,
            'msg'     => $message,
            'data'    => $data,
        ];
    }
}


