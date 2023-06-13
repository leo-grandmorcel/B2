<?php

function reverse($array) : array{
    return array_reverse($array);
}

function push(&$array, ...$strings) : int{
    foreach ($strings as $string) {
        array_push($array, $string);
    }
    return count($array);
}

function sum($array) : int{
    return array_sum($array);
}

function arrayContains($array, $value) : mixed{
    if (in_array($value, $array)) {
        return $value;
    } else {
        return "Nothing";
    }
}

function merge(...$arrays) : array{
    return array_merge(...$arrays);
}