<?php

function f (){
    return array("+"=> function ($a,$b){return $a+$b;},
    "-"=> function ($a,$b){return $a-$b;},
    "*"=> function ($a,$b){return $a*$b;});
}