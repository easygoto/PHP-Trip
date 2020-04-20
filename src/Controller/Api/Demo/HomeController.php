<?php

namespace Trink\Frame\Controller\Api\Demo;

use Trink\Core\Helper\Result;
use Trink\Frame\Component\BaseController;

class HomeController extends BaseController
{
    public function momentsSetting()
    {
        return Result::success('OK', [
            'nickname' => 'admin',
            'custom_sign' => 'everything is be OK',
            'avatar' => 'http://make.trink.com/upload/images/77.jpg',
            'bg_image' => 'http://make.trink.com/upload/images/88.jpg',
        ])->asJson();
    }

    public function momentsNews()
    {
        return Result::success('OK', [
            ['day' => '20', 'month' => '4月', 'content' => '故友相见, 感触良多', 'images' => [
                'http://make.trink.com/upload/images/11.jpg',
                'http://make.trink.com/upload/images/22.jpg',
                'http://make.trink.com/upload/images/33.jpg',
                'http://make.trink.com/upload/images/44.jpg',
                'http://make.trink.com/upload/images/55.jpg',
                'http://make.trink.com/upload/images/66.jpg',
                'http://make.trink.com/upload/images/77.jpg',
                'http://make.trink.com/upload/images/88.jpg',
            ]],
            ['day' => '10', 'month' => '4月', 'content' => '现在有点儿意思了', 'images' => [
                'http://make.trink.com/upload/images/11.jpg',
                'http://make.trink.com/upload/images/22.jpg',
                'http://make.trink.com/upload/images/33.jpg',
            ]],
            ['day' => '03', 'month' => '4月', 'content' => '继续努力, 加油', 'images' => [
                'http://make.trink.com/upload/images/44.jpg',
                'http://make.trink.com/upload/images/55.jpg',
                'http://make.trink.com/upload/images/66.jpg',
            ]],
            ['day' => '31', 'month' => '3月', 'content' => '今天又是美好的一天', 'images' => [
                'http://make.trink.com/upload/images/77.jpg',
            ]],
            ['day' => '20', 'month' => '2月', 'content' => '下雪了, 真好看', 'images' => [
                'http://make.trink.com/upload/images/88.jpg',
            ]],
        ])->asJson();
    }
}
