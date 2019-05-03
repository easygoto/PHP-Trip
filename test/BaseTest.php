<?php


namespace Demo\Test;

use PHPUnit\Framework\TestCase;
use Redis;
use ReflectionClass;
use ReflectionObject;
use Trink\Demo\Util\DB;
use Trink\Demo\Test\Algorithm;
use Trink\Demo\Test\Node;
use Trink\Demo\Test\Person;
use ZipArchive;

/**
 * Class BaseTest
 *
 * @package Demo\Test
 */
class BaseTest extends TestCase
{
    public function test()
    {
        $result = DB::instance()
            ->table('order')
            ->where([
                'id' => 12,
            ])
            ->getRow();
        var_dump($result);
        $this->assertTrue(true);
    }

    /** @test */
    public function zone2Db()
    {
        $zoneArray = [];
        $fp      = fopen('res/zone_code.csv', 'r');
        while (($content = fgetcsv($fp)) != null) {
            $zoneArray[$content[1]] = $content[0];
        }

        $zoneList = [];
        foreach ($zoneArray as $key => $value) {
            $name = $value;
            $code = (int)$key;
            if (in_array($code, [100000, 900000])) {
                $type = 'country';
                continue;
            }
            if ($code % 10000 == 0) {
                // 省
                $type         = 'province';
                $areaCode     = '';
                $areaName     = '';
                $cityCode     = '';
                $cityName     = '';
                $provinceCode = $code;
                $provinceName = $zoneArray["$provinceCode"] ?? '';
                $parentCode   = 100000;
            } elseif ($code % 100 == 0) {
                // 市
                $type         = 'city';
                $areaCode     = '';
                $areaName     = '';
                $cityCode     = $code;
                $cityName     = $zoneArray["$cityCode"] ?? '';
                $provinceCode = intval($code / 10000) * 10000;
                $provinceName = $zoneArray["$provinceCode"] ?? '';
                $parentCode   = $provinceCode;
            } else {
                // 区
                $type         = 'area';
                $areaCode     = $code;
                $areaName     = $zoneArray["$code"] ?? '';
                $cityCode     = intval($code / 100) * 100;
                $cityName     = $zoneArray["$cityCode"] ?? '';
                $provinceCode = intval($code / 10000) * 10000;
                $provinceName = $zoneArray["$provinceCode"] ?? '';
                $parentCode   = $cityCode;
            }
            $path       = trim($provinceName . '|' . $cityName . '|' . $areaName, '|');
            $codePath   = trim($provinceCode . '|' . $cityCode . '|' . $areaCode, '|');
            $zoneList[] = sprintf("('%s',%d,%d,'%s','%s','%s')", $name, $code, $parentCode, $path, $codePath, $type);
        }

        $sql = /** @lang text */
            'insert into `address` (`name`,`code`,`parent_code`,`path`,`code_path`,`type`) values ';
        $sql .= implode(',', $zoneList);
        file_put_contents('res/address.sql', $sql);

        //$pdo = new PDO('mysql:host=localhost;dbname=test;port=3306', 'root', '123123');
        //var_dump($pdo->query($sql));

        $this->assertTrue(true);
    }

    /** @test */
    public function patchAllMethod()
    {
        $filename = __DIR__ . '/res/wxapp.txt';
        $docs     = file_get_contents($filename);
        $pattern = "/public\s+?function\s+?doPage(\w+)\s*?\(\s*?\)/";
        $total = preg_match_all($pattern, $docs, $matches, PREG_OFFSET_CAPTURE);
        $spaceCount = 8;

        $methodList    = array_column($matches[1], 1, 0);

        foreach ($methodList as $methodName => $methodTag) {
            $inMethod        = false;
            $tagCount        = 0;

            for ($currentIndex = $methodTag; $currentIndex < strlen($docs); $currentIndex ++) {
                $currentChar = $docs[$currentIndex];
                if ($currentChar === '{') {
                    $tagCount ++;
                    if (! $inMethod) {
                        $methodStart = $currentIndex + 1;
                        $inMethod    = true;
                    }
                } elseif ($currentChar === '}') {
                    $tagCount --;
                }
                if ($inMethod && $tagCount === 0 && isset($methodStart)) {
                    $content = substr($docs, $methodStart, $currentIndex - $methodStart);

                    $lineList = [];
                    array_map(function ($line) use (&$lineList) {
                        if (trim($line)) {
                            $lineList[] = $line;
                        }
                    }, explode("\n", $content));

                    foreach ($lineList as $lineIndex => $line) {
                        $lineList[$lineIndex] = substr($line, $spaceCount);
                    }

                    $formattedContent = "<?php\n\n";
                    $formattedContent .= implode("\n", $lineList);
                    $formattedContent .= "\n";

                    $methodName = strtolower($methodName);
                    file_put_contents(__DIR__ . "/res/inc/{$methodName}.inc.php", $formattedContent);
                    break;
                }
            }
        }

        print "{$total}\n";
        $this->assertTrue(true);
    }

    /** @test */
    public function mergeSort()
    {
        $input = [];
        for ($i = 0; $i < 2000; $i ++) {
            array_push($input, mt_rand(0, 100000000));
        }
        Algorithm::mergeSort($input);
        $this->assertTrue(true);
    }

    /** @test */
    public function node()
    {
        $list = Node::fromArray([1, 5, 2, 8, 9, 4, 7, 6, 3]);
        $this->assertEquals($list->length(), 9);
        $list->sort();
        $this->assertEquals($list->toArray(), [1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    /** @test */
    public function match()
    {
        $persons1    = ['A', 'B', 'C', 'D'];
        $persons2    = ['a', 'b', 'c', 'd'];
        $exclude_map = ['a' => ['A'], 'c' => ['B', 'C']];
        Algorithm::match($persons1, $persons2, $exclude_map);
        $this->assertTrue(true);
    }

    /** @test */
    public function yuMatch()
    {
        $persons1    = ['A', 'B', 'C', 'D'];
        $persons2    = ['a', 'b', 'c', 'd'];
        $exclude_map = ['a' => ['A'], 'c' => ['B', 'C']];
        Algorithm::yuMatch($persons1, $persons2, [], $exclude_map);
        $this->assertTrue(true);
    }

    /** @test */
    public function zip()
    {
        $filename = "./" . date('YmdH') . ".zip"; // 最终生成的文件名（含路径）
        // 生成文件
        $zip = new ZipArchive(); // 使用本类，linux需开启zlib，windows需取消php_zip.dll前的注释
        if ($zip->open($filename, \ZipArchive::OVERWRITE) !== true) {  //OVERWRITE 参数会覆写压缩包的文件 文件必须已经存在
            if ($zip->open($filename, \ZipArchive::CREATE) !== true) {
                exit('无法打开文件，或者文件创建失败');
            }
        }

        $fileName = "main.js"; //存放文件的真实路径

        if (file_exists($fileName)) {
            $zip->addFile($fileName, basename('main.js'));//第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下 写上目录就会存放至目录
            $zip->addFile($fileName, basename('test.php'));//第二个参数是放在压缩包中的文件名称，如果文件可能会有重复，就需要注意一下 写上目录就会存放至目录
        }

        $zip->close(); // 关闭
        $this->assertTrue(true);
    }

    /** @test */
    public function pattern()
    {
        $pattern = '/(\<(\w+)\>).+?(\<\/\2\>)/';
        $text    = '<div><ul><li><a></a><span></span></li><li><a></a><span></span></li></ul></div>';
        preg_match_all($pattern, $text, $matches);
        print_r($matches);

        $pattern = '#\[url\](?<WORD>\d\.gif)\[\/url\]#';
        $text    = '[url]1.gif[/url][url]2.gif[/url][url]3.gif[/url]';
        var_dump(preg_replace($pattern, "<img src=http://image.ai.com/upload/$1 alt>", $text));
        $this->assertTrue(true);
    }

    /** @test */
    public function reflection()
    {
        $person = new Person;

        // 反射获取对象的属性
        $reflect = new ReflectionObject($person);
        print_r($reflect->getProperties());
        print_r($reflect->getMethods());

        // 使用 class 函数
        print_r(get_object_vars($person));               // 对象关联数组
        print_r(get_class_vars(get_class($person)));     // 类属性
        print_r(get_class_methods($person));             // 类方法名数组

        // 反射 API
        $obj       = new ReflectionClass('Trink\Demo\Test\Person');
        $className = $obj->getName();
        var_dump($className);

        $methods    = [];
        $properties = [];
        foreach ($obj->getMethods() as $value) {
            $methods[$value->getName()] = $value;
        }
        foreach ($obj->getProperties() as $value) {
            $properties[$value->getName()] = $value;
        }
        var_dump($methods);
        var_dump($properties);
        $this->assertTrue(true);
    }

    /** @test */
    public function redis()
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->set("string-name", "Redis Tree Link ...");
        print sprintf("Stored string in redis: %s\n\n", $redis->get("string-name"));

        $redis->lpush("list-name", "Redis");
        $redis->lpush("list-name", "Mongodb");
        $redis->lpush("list-name", "Mysql");
        print_r($redis->lrange("list-name", 0, 20));
        print "\n";

        print "Stored keys in redis::";
        print_r($redis->keys("*"));
        $this->assertTrue(true);
    }
}
