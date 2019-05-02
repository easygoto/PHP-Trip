<?php


namespace Trink\Demo\Test;

class AlgorithmBacktracking
{
    private static function innerMatch($person_list, $index, &$all)
    {
        $len = count($person_list);
        if ($len == $index) {
            $all[] = $person_list;
        }

        for ($i = $index; $i < $len; $i ++) {
            $temp_list         = $person_list;
            $temp              = $temp_list[$i];
            $temp_list[$i]     = $temp_list[$index];
            $temp_list[$index] = $temp;
            self::innerMatch($temp_list, $index + 1, $all);
        }
    }

    public static function match($persons1, $persons2, $exclude_map)
    {
        self::innerMatch($persons1, 0, $all);
        $result = [];
        foreach ($all as $person_list) {
            $is_end = false;
            foreach ($exclude_map as $key => $exclude_list) {
                $idx = array_search($key, $persons2);
                if (in_array($person_list[$idx], $exclude_list)) {
                    $is_end = true;
                    break;
                }
            }
            if ($is_end) {
                continue;
            }
            $result[] = $person_list;
        }
        foreach ($result as $aResult) {
            $len = count($aResult);
            for ($i=0; $i<$len; $i++) {
                echo "{$persons2[$i]}-{$aResult[$i]} ";
            }
            echo "\n";
        }
        return $result;
    }

    public static function yuMatch($players1, $players2, $include, $exclude, $level = 0, $list = [])
    {
        if ($level === count($players1)) {
            for ($i = 0; $i<$level; $i++) {
                if (isset($include[$players2[$i]]) && !in_array($list[$i], $include[$players2[$i]])) {
                    return ;
                }
                if (in_array($list[$i], $exclude[$players2[$i]] ?? [])) {
                    return ;
                }
            }
            for ($i = 0; $i < $level; $i++) {
                echo $players2[$i] . '-' . $list[$i] . ',';
            }
            echo "\n";
            return;
        }
        foreach ($players1 as $player) {
            if (! in_array($player, $list)) {
                $list[$level] = $player;
                self::yuMatch($players1, $players2, $include, $exclude, $level + 1, $list);
            }
        }
    }
}
