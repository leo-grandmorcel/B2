<?php

function findMaximumSubarray($numbers) : int|float {
    if (empty($numbers)) {
        return 0;
    }
    $best_sum = 0;
    $current_sum = 0;
    foreach($numbers as $number){
        $current_sum = max(0, $current_sum + $number);
        $best_sum = max($best_sum,$current_sum);
    }
    return $best_sum;
}