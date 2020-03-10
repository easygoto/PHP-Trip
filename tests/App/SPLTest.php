<?php

namespace Test\Trip\App;

use AppendIterator;
use ArrayIterator;
use ArrayObject;
use FilesystemIterator;
use MultipleIterator;
use Test\Trip\TestCase;
use RecursiveIterator;
use SeekableIterator;
use SplDoublyLinkedList;
use SplMinHeap;
use SplPriorityQueue;
use SplQueue;
use SplStack;
use Trink\App\Trip\Demo\Counter;
use Trink\App\Trip\Demo\OuterImpl;

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
        $this->assertCount(7, $linked_list);

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
        print $stack->serialize() . "\n";

        $this->assertCount(5, $stack);
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
    public function minHeap()
    {
        $heap = new SplMinHeap();

        $heap->insert(5);
        $heap->insert(4);
        $heap->insert(1);
        $heap->insert(3);
        $heap->insert(7);
        $heap->insert(6);
        $heap->insert(9);

        while ($heap->valid()) {
            echo $heap->extract();
        }

        $this->assertTrue(true);
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
        $it  = $obj->getIterator();
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

    /** @test */
    public function appendIterator()
    {
        $list1 = [1, 2, 3];
        $list2 = ['a', 'b', 'c'];

        $it1 = new ArrayIterator($list1);
        $it2 = new ArrayIterator($list2);

        $it = new AppendIterator();
        $it->append($it1);
        $it->append($it2);

        while ($it->valid()) {
            print "{$it->key()} : {$it->current()}\n";
            $it->next();
        }

        $this->assertTrue(true);
    }

    /** @test */
    public function multipleIterator()
    {
        $id_list   = [1, 2, 3];
        $name_list = ['trink', 'easy', 'hello'];
        $age_list  = [20, 21, 22];

        $id_it   = new ArrayIterator($id_list);
        $name_it = new ArrayIterator($name_list);
        $age_it  = new ArrayIterator($age_list);

        // 合并数组，保留键值
        $mit = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
        $mit->attachIterator($id_it, 'id');
        $mit->attachIterator($name_it, 'name');
        $mit->attachIterator($age_it, 'age');

        while ($mit->valid()) {
            print_r($mit->current());
            $mit->next();
        }
        $this->assertTrue(true);
    }

    /** @test */
    public function fileSystemIterator()
    {
        $path = dirname(__DIR__);
        $fit  = new FilesystemIterator($path);
        while ($fit->valid()) {
            printf(
                "%-30s%-8s%15s  %s\n",
                date('Y-m-d H:i:s', $fit->getMTime()),
                ($fit->isDir() ? '[DIR]' : '[FILE]'),
                number_format($fit->getSize()),
                $fit->getFilename()
            );
            $fit->getPathname();
            $fit->next();
        }
        $this->assertTrue(true);
    }

    /** @test */
    public function countable()
    {
        $list = [
            ['id' => 1, 'name' => 'LiJ'],
            ['id' => 2, 'name' => 'easy'],
            ['id' => 3, 'name' => 'trink'],
        ];
        $this->assertCount(3, $list);
        $this->assertCount(5, (new Counter));
    }

    /** @test */
    public function outerIterator()
    {
        // 失败了，咋回事？
        $outer = new OuterImpl(new ArrayObject([
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        ]));
        while ($outer->valid()) {
            print "{$outer->key()}-{$outer->current()}\n";
            $outer->next();
        }
        $this->assertTrue(true);
    }

    public function others()
    {
        RecursiveIterator::class; // 接口，多层结构遍历
        SeekableIterator::class; // 接口，迭代器中定位
    }
}
