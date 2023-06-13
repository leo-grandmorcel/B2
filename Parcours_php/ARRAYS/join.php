<?php

function joinwords($array, $separator = " ") : string{
    $myString = "";
    foreach ($array as $word) {
        $myString .= $word . $separator;
    }
    return substr($myString, 0, -1);
}