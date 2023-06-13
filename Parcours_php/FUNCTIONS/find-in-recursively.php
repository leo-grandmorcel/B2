<?php

function findIn($key, $array) : string | bool{
    if (array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        foreach ($array as $value) {
            if (is_array($value)) {
                return findIn($key, $value);
            }
        }
    }
    return false;
}