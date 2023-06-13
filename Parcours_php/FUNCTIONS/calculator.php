<?php

function calc($calculation) : int{
    return eval("return $calculation;");
}