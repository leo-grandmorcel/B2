<?php

function reverse($myString) : string{
    return strrev($myString);
}

function isPalindrome($myString) : bool{
    return $myString === reverse($myString);
}