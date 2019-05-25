<?php


namespace Test\Demo;

use ArrayObject;
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
        // SplDoublyLinkedList::flags = 0
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
    public function stack()
    {
        // 继承 SplDoublyLinkedList 类，未添加方法
        $stack = new SplStack;

        $stack->push(1);
        $stack->push(3);
        $stack->push(4);
        $stack->push(7);
        $stack->push(9);

        // *SplDoublyLinkedList*flags = 6
        print $stack->serialize();

        $this->assertEquals(9, $stack->top());
        $this->assertEquals(1, $stack->bottom());

        $this->assertEquals(9, $stack->pop());
        $this->assertEquals(7, $stack->top());
        print $stack->serialize() . "\n";
    }

    /** @test */
    public function queue()
    {
        // 继承 SplDoublyLinkedList 类
        $queue = new SplQueue();
        $queue->enqueue(1);
        $queue->enqueue(2);
        $queue->enqueue(3);
        $queue->enqueue(4);
        $queue->enqueue(5);

        // *SplDoublyLinkedList*flags = 4
        print $queue->serialize() . "\n";
        $this->assertEquals(1, $queue->dequeue());
        print $queue->serialize() . "\n";
    }

    /** @test */
    public function priorityQueue()
    {
        // 根据第二个参数(优先级)排序的队列
        $priorityQueue = new SplPriorityQueue();
        $priorityQueue->insert(4563, 2);
        $priorityQueue->insert(8563, 2);
        $priorityQueue->insert(2776, 10);
        $priorityQueue->insert(1324, 5);

        $priorityQueue->rewind();
        $this->assertEquals(2776, $priorityQueue->top());
        $this->assertEquals(2776, $priorityQueue->current());
        $priorityQueue->next();
        $this->assertEquals(1324, $priorityQueue->current());

        $priorityQueue->insert(8562, 3);
        $priorityQueue->insert(5562, 4);
        $priorityQueue->insert(7524, 4);

        $priorityQueue->next();
        $this->assertEquals(5562, $priorityQueue->current());
        $priorityQueue->next();
        $this->assertEquals(7524, $priorityQueue->current());
        $priorityQueue->next();
        $this->assertEquals(8562, $priorityQueue->current());
    }

    /** @test */
    public function arrayIterator()
    {
        $fruit_list = [
            'apple'  => 'apple value',
            'orange' => 'orange value',
            'grape'  => 'grape value',
            'plum'   => 'plum value',
        ];

        $obj = new ArrayObject($fruit_list);
        $it = $obj->getIterator();
        foreach ($it as $key => $value) {
            print "{$key} : {$value}\n";
        }

        print "\n---------------------\n\n";

        $it->rewind();
        while ($it->valid()) {
            print "{$it->key()} : {$it->current()}\n";
            $it->next();
        }

        print "\n---------------------\n\n";

        $it->rewind();
        if ($it->valid()) {
            $it->seek(2);
            while ($it->valid()) {
                print "{$it->key()} : {$it->current()}\n";
                $it->next();
            }
        }

        print "\n---------------------\n\n";

        $it->rewind();
        $it->ksort();
        while ($it->valid()) {
            print "{$it->key()} : {$it->current()}\n";
            $it->next();
        }


        $this->assertTrue(true);
    }
}
