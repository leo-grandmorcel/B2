<?php

# Create a manageMovements function which takes a string of characters among R, L, F, B and returns an array containing the list of instructions to give to the robot.
function manageMovements($string) : array {
    $instructions = str_split($string);
    $result = [];
    foreach($instructions as $value){
        if($value == "R"){
            if (end($result) == "RIGHT"){
                array_push($result,"RIGHT AGAIN");
            }else{
                array_push($result,"RIGHT");
            }
        }
        elseif($value == "L"){
            if (end($result) == "LEFT"){
                array_push($result,"LEFT AGAIN");
            }else{
                array_push($result,"LEFT");
            }
        }
        elseif($value == "F"){
            if (end($result) == "FRONT"){
                array_push($result,"FRONT AGAIN");
            }else{
                array_push($result,"FRONT");
            }
        }
        elseif($value == "B"){
            if (end($result) == "BACKWARDS"){
                array_push($result,"BACKWARDS AGAIN");
            }else{
                array_push($result,"BACKWARDS");
            }
        }
    }
    return $result;
}