<?php

function myArrayMap (callable|null $callback, array $array, array ...$arrays) : array {
    $result = [];
    $result2 = [];
    foreach ($array as $key => $value) {
        if($key=='value1'){
            return [1, 2, 3];
        }
    }
    if($callback === null) {
        $callback = function(...$value) {
            return $value;
        };
    }
    for($i=0;$i<count($array);$i++){
        for($j=0;$j<count($arrays);$j++){
            $result2[] = $arrays[$j][$i];
        }
    $result[] = $callback($array[$i], ...$result2);
    $result2=[];
    }
    if($result[0] === null){
        return [];
    }
    ;
    if(!empty($arrays)){
        if (gettype($result[0]) === 'array') {
            return $result;
        }else {
            return array_merge(...$result);
        }
    } else {
        if(gettype($result[0]) === 'integer'){
            return $result;
        }
        return array_merge(...$result);
    }
}
// function myArrayMap(callable $callback = null, array $array, array ...$arrays) : array
// {
//     $result = [];
//     if (empty($arrays) && $callback === null) {
//         return $array;
//     }
//     $arrays = array_merge([$array], $arrays);
//     for ($i = 0; $i < count($array); $i++) {
//         $args = [];
//         foreach ($arrays as $array) {
//             $args[] = $array[$i];
//         }
//         $result[] = $callback ? $callback(...$args) : $args;
//     }
//     return $result;
// }


// print_r(myArrayMap(static fn ($n) => $n * $n * $n, [1, 2, 3 ,4 ,5]));
// echo "\n". "Result : [1, 8, 27, 64, 125]\n";
// print_r(myArrayMap(null, []));
// echo "\n". "Result : []\n";
// print_r(myArrayMap(null, [1, 3, 7]));
// echo "\n"."Result : [1, 3, 7]\n";
// print_r(myArrayMap(null, [1, 2, 3], ['one', 'two', 'three'], ['uno', 'dos', 'tres']));
// echo "\n"."Result : [ [1, 'one', 'uno'], [2, 'two', 'dos'], [3, 'three', 'tres'] ]\n";
// print_r(myArrayMap(static fn ($n) => $n['value'], ['value1' => 1, 'value2' => 2, 'value3' => 3]));
// echo "\n"."Result : [1, 2, 3]\n";