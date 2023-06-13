<?php

function myArrayReduce(array $array, callable $callback, $initial = null) : mixed {
    $result = $initial;
    foreach ($array as $key => $value) {
        $result = $callback($result, $value, $key, $array);
    }
    return $result;
}