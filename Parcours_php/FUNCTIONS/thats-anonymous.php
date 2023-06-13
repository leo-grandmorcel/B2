<?php

$today = function () use ($date) {
    return "It is ".date('F')." ".date('d').", ". date('Y');
};

$isLeapYear = function ($year) {
    return ($year % 400 == 0) || ($year % 4 == 0 && $year % 100 != 0);
};