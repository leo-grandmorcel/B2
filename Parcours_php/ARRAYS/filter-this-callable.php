<?php

function myArrayFilter(array $array, ?callable $callback = null): array {
    $result = [];
    if ($callback === null) {
        $callback = function($value) {
            return $value;
        };
    }
    foreach ($array as $key => $value) {
        if ($callback($value, $key, $array)) {
            $result += array($key => $value);
        }
    }
    return $result;
}