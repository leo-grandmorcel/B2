<?php

function checkCircuits( int $errCode) : array {
    #we find by which prime numbers it is divisible and we refer to the following table
    $table = array(2=>"Left arm",3=>"Right arm",5=>"Motherboard",7=>"Processor",11=>"Zip Defluxer",13=>"Motor");
    $result = [];
    foreach($table as $divisor => $value){
        if($errCode % $divisor == 0){
            array_push($result,$value);
        }
    }	
    return $result;
}