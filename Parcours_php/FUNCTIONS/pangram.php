<?php

function isPangram($myString) : bool{
    $alphabet = range('a', 'z');
    return count(array_intersect(array_unique(str_split(strtolower($myString))), $alphabet)) === count($alphabet);
}