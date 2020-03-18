<?php

namespace Trink\Core\Component;

class Logger
{
    public static function print($data)
    {
        if (is_array($data) || is_object($data)) {
            print json_encode($data);
        } elseif (is_bool($data) || is_resource($data)) {
            print var_export($data, true);
        } else {
            print sprintf("%s", $data);
        }
    }

    public static function println($data)
    {
        if (is_array($data) || is_object($data)) {
            print json_encode($data) . "\n";
        } elseif (is_bool($data) || is_resource($data)) {
            print var_export($data, true) . "\n";
        } else {
            print sprintf("%s\n", $data);
        }
    }

    public static function toFile($data, $level = 'normal')
    {
        $log = date('Y-m-d H:i:s') . "\n";
        if (is_array($data) || is_object($data)) {
            $log .= json_encode($data) . "\n\n";
        } elseif (is_bool($data) || is_resource($data)) {
            $log .= var_export($data, true) . "\n\n";
        } else {
            $log .= sprintf("%s\n\n", $data);
        }
        file_put_contents(TEMP_DIR . 'swoole' . $level . '.log', $log, FILE_APPEND);
    }
}
