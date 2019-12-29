<?php


namespace Test\Trip\App\Demo;

use stdClass;
use Test\Trip\TestCase;
use Trink\Frame\Container\App;

class MemcacheTest extends TestCase
{
    public function test()
    {
        $mcCnf = App::instance()->setting->get('mc');
        $memcache = memcache_pconnect($mcCnf['host'], $mcCnf['port']);
        if (!$memcache) {
            $this->expectErrorMessage('Connection to memcached failed');
        }

        $memcache->set("strKey", "String to store in memcached");
        var_dump($memcache->get('strKey'));
        $this->assertIsString($memcache->get('strKey'));

        $memcache->set("numKey", 123);
        var_dump($memcache->get('numKey'));
        $this->assertIsInt($memcache->get('numKey'));

        $object = new StdClass;
        $object->attribute = 'test';
        $memcache->set("objKey", $object);
        var_dump($memcache->get('objKey'));
        $this->assertIsObject($memcache->get('objKey'));

        $array = ['assoc' => 123, 345, 567];
        $memcache->set("arrKey", $array);
        var_dump($memcache->get('arrKey'));
        $this->assertIsArray($memcache->get('arrKey'));
    }
}
