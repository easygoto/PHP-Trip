<?php

namespace Trink\Core\Component;

class Logger
{
    public const CLI_COLOR_BLACK = 30;
    public const CLI_COLOR_RED = 31;
    public const CLI_COLOR_GREEN = 32;
    public const CLI_COLOR_YELLOW = 33;
    public const CLI_COLOR_BLUE = 34;
    public const CLI_COLOR_PURPLE = 35;
    public const CLI_COLOR_DARK_GREEN = 36;
    public const CLI_COLOR_WHITE = 37;

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
        if (preg_match("/cli/i", PHP_SAPI)) {
            $endLine = PHP_EOL;
        } else {
            $endLine = '<br>';
        }

        if (is_array($data) || is_object($data)) {
            print json_encode($data) . $endLine;
        } elseif (is_bool($data) || is_resource($data)) {
            print var_export($data, true) . $endLine;
        } else {
            sprintf("%s{$endLine}", gettype($data));
        }
    }

    /**
     * @param int          $color 可以使用预设的 Logger::CLI_COLOR 设置
     * @param string       $title 提示信息
     * @param string|array $desc  提示信息详情
     */
    public static function cliLn(int $color, string $title, $desc = '')
    {
        $title = sprintf('%-20s', $title);
        if (is_string($desc)) {
            print "\e[{$color}m{$title}\t\e[0m{$desc}\n";
        } elseif (is_array($desc)) {
            $blank = sprintf('%-20s', '');
            $message = implode("\n{$blank}\t", $desc);
            print "\e[{$color}m{$title}\t\e[0m{$message}\n";
        } else {
            print "\e[{$color}m{$title}\t\e[0m\n";
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
