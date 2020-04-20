<?php

namespace Trink\Frame\View;

class Asset
{
    public const RS = [
        'bs4.css' => 'bootstrap4.css.html',
        'pop.js' => 'popper.js.html',
        'bs4.js' => 'bootstrap4.js.html',
        'jq3.js' => 'jquery3.js.html',
        'vue.js' => 'vue.js.html',
        'axo.js' => 'axios.js.html'
    ];

    /**
     * 加载资源
     *
     * @param string $filename
     * @return string
     */
    public static function load($filename = '')
    {
        $filePath = __DIR__ . "/framework/{$filename}";
        return is_file($filePath) ? file_get_contents($filePath) : '';
    }
}
