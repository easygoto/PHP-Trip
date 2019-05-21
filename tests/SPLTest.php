<?php


namespace Test\Demo;

use PHPUnit\Framework\TestCase;
use SplDoublyLinkedList;
use SplPriorityQueue;
use SplQueue;
use SplStack;

class SPLTest extends TestCase
{
    /** @test */
    public function doublyLinkedList()
    {
        $linked_list = new SplDoublyLinkedList;

        // push 尾部加入
        $example_array = [1, 2, 3, 4, 5];
        array_map(function ($value) use ($linked_list) {
            $linked_list->push($value);
        }, $example_array);

        // unshift 头部加入
        $linked_list->unshift(10);
        $linked_list->unshift(100);
        $this->assertEquals(7, $linked_list->count());

        // 指向头节点
        $linked_list->rewind();
        $this->assertEquals(100, $linked_list->current());

        $linked_list->next();
        $linked_list->next();
        $linked_list->next();
        $linked_list->next();
        $this->assertEquals(3, $linked_list->current());


        $linked_list->prev();
        $linked_list->prev();
        $linked_list->prev();
        $this->assertEquals(10, $linked_list->current());

        // pop 尾部删除
        $this->assertEquals(5, $linked_list->pop());

        // shift 头部删除
        $this->assertEquals(100, $linked_list->shift());

        $this->assertEquals(4, $linked_list->top());
        $this->assertEquals(10, $linked_list->bottom());
    }

    /** @test */
    public function test()
    {
        $stack = new SplStack;
        $queue = new SplQueue();
        $priorityQueue = new SplPriorityQueue();
    }
}
