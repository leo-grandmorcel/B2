<?php

function explodeWords($string, $separator= " ", $limit = PHP_INT_MAX) : array {
    $words = [];
    $start = 0;
    $count = 0;
    $separatorLength = strlen($separator);
    while (($pos = strpos($string, $separator, $start)) !== false) {
        if ($limit !== null && $count >= $limit - 1 && $limit > 0) {
            break;
        }
        $words[] = substr($string, $start, $pos - $start);
        $start = $pos + $separatorLength;
        $count++;
    }
    $words[] = substr($string, $start);
    if ($limit <0){
        $words = array_slice($words,0,$limit);
    }
    return $words;
}