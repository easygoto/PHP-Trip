<?php


namespace Test\Trip\App\Demo;

use stdClass;
use Test\Trip\TestCase;
use Trink\App\Trip\Distribute\Consistent;
use Trink\App\Trip\Distribute\McModel;
use Trink\Frame\Container\App;

class MemcacheTest extends TestCase
{
    public function test()
    {
        $mc = App::instance()->mc->mc();
        $num = 2e4;
        $key = 'test:' . substr(uniqid(), -6);

        for ($i = 0; $i < $num; $i++) {
            $simArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            $array = [
                'a' => rand(1e3, 1e4 - 1),
                'b' => "string{$i}",
                'c' => new StdClass,
                'd' => $simArray,
                'e' => (function () use ($simArray) {
                    $obj = new StdClass;
                    $obj->array = $simArray;
                    $obj->number = rand(1e6, 1e7 - 1);
                    return $obj;
                })(),
            ];
            $bigArray = [$array, $array, $array, $array, $array, $array, $array, $array, $array, $array, $array];
            $supArray = [$bigArray, $bigArray, $bigArray, $bigArray, $bigArray, $bigArray, $bigArray, $bigArray];
            $object = new StdClass;
            $object->numAttr = rand(1e8, 1e9 - 1);
            $object->arrAttr = $array;
            $object->arrAttr2 = $bigArray;
            $mc->set("{$key}:str:{$i}", "String{$i} to store in memcached");
            $mc->set("{$key}:obj:{$i}", $object);
            $mc->set("{$key}:num:{$i}", rand(1e3, 1e4 - 1));
            $mc->set("{$key}:arr:{$i}", $supArray);
        }

        $this->assertTrue(true);
    }

    /** @test */
    public function distribute()
    {
        $model = new McModel();
        $model->addServer('a');
        $model->addServer('b');
        $model->addServer('c');

        $stat = [];
        for ($i = 0; $i < 100; $i++) {
            $key = 'key_' . $i;
            $stat[$model->lookup($key)][] = $key;
        }
        $this->assertTrue(true);
    }

    /** @test */
    public function consistent()
    {
        $consistent = new Consistent();
        $consistent->addServer('A');
        $consistent->addServer('B');
        $consistent->addServer('C');
        $consistent->addServer('D');

        $beforeStat = [];
        $afterStat = []; // 如果 A 服务器宕机, 其他服务器的分摊情况
        $failServer = false;
        $beforePoints = $consistent->getPoints();
        foreach ($beforePoints as $pKey => $point) {
            $beforeStat[$point][] = $pKey;
            if ($point != 'A' && $failServer == true) {
                $afterStat[$point][] = $pKey;
                $failServer = false;
            }
            if ($point == 'A') {
                $failServer = true;
            }
        }
        echo json_encode($beforePoints);

        $consistent->delServer('A');
        echo json_encode($consistent->getPoints());
        $this->assertTrue(true);
    }

    /** @test */
    public function getSlabsDetail()
    {
        $mc = App::instance()->mc->mc();
        $serverList = $mc->getExtendedStats('slabs');
        foreach ($serverList as $serverName => &$serverSlabs) {
            ['active_slabs' => $activeSlabs, 'total_malloced' => $totalMalloced] = $serverSlabs;
            $slabsList = array_filter($serverSlabs, fn ($key) => is_numeric($key), ARRAY_FILTER_USE_KEY);
            $serverSlabs = [
                'activeSlabs'   => $activeSlabs,
                'totalMalloced' => $totalMalloced,
                'slabsList'     => $slabsList,
            ];
        }

        foreach ($serverList as $serverName => $item) {
            $slabsList = $item['slabsList'];
            foreach ($slabsList as $slabsId => $_) {
                $allCache = $mc->getExtendedStats('cachedump', $slabsId, $_['used_chunks']);
                foreach ($allCache as $serverName => $value) {
                    $cacheKeyList = array_keys($value ?: []);
                    $serverName = str_replace(':', '.', $serverName);
                    file_put_contents(TEMP_DIR . "mc/{$serverName}.{$slabsId}.json", json_encode([
                        'cacheKeyList' => $cacheKeyList,
                    ]));
                }
            }
        }

        file_put_contents(TEMP_DIR . "mc/basic.json", json_encode($serverList));
        $this->assertTrue(true);
        return $serverList;
    }
}
