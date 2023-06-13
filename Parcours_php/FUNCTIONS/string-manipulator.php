<?php

function capsMe($myString) : string{
    return strtoupper($myString);
}

function lowerMe($myString) : string{
    return strtolower($myString);
}

function upperCaseFirst($myString) : string{
    return implode(" ", array_map("ucfirst", explode(" ", $myString)));
}

function lowerCaseFirst($myString) : string{
    return implode(" ", array_map("lcfirst", explode(" ", $myString)));
}

function removeBlankSpace($myString) : string{
    return trim($myString);
}