<?php

namespace Trink\Trip\App\Demo;

/**
 * Class Node
 *
 * @package Trink\Trip\App\Demo
 */
class Node
{
    private $data;

    private $next = null;

    /**
     * 数组转单链表
     *
     * @param array $arr 初始数组
     *
     * @return Node
     */
    public static function fromArray(array $arr): Node
    {
        //
        $head = new Node();
        array_reduce($arr, function ($prev_node, $data) {
            $new_node        = new Node();
            $new_node->data  = $data;
            $prev_node->next = $new_node;
            return $new_node;
        }, $head);
        return $head;
    }

    /**
     * 单链表转数组
     *
     * @return array
     */
    public function toArray(): array
    {
        $arr = [];
        /** @var Node $node */
        for ($node = $this->next; $node; $node = $node->next) {
            array_push($arr, $node->data);
        }
        return $arr;
    }

    /**
     * 链表的长度
     *
     * @return int
     */
    public function length(): int
    {
        $i = 0;
        /** @var Node $node */
        for ($node = $this->next; $node; $i ++) {
            $node = $node->next;
        }
        return $i;
    }

    /**
     * 对链表排序
     *
     * @return void
     */
    public function sort()
    {
        $head = new Node();
        /** @var Node $node */
        $node = $this->next;
        while ($node) {
            $data       = $node->data;
            $temp       = new Node();
            $temp->data = $data;
            if ($head->next == null) {
                $temp->next = null;
                $head->next = $temp;
            } else {
                $previous = $head;
                /** @var Node $current */
                $current  = $head->next;
                while ($current != null) {
                    if ($data < $current->data) {
                        $temp->next     = $current;
                        $previous->next = $temp;
                        break;
                    }
                    if ($current->next == null) {
                        $temp->next     = null;
                        $current->next = $temp;
                        break;
                    }
                    $previous = $previous->next;
                    $current  = $current->next;
                }
            }
            $node = $node->next;
        }
        $this->next = $head->next;
    }
}
