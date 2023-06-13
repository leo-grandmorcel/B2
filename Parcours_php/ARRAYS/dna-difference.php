<?php

function dnaDiff($dna1, $dna2) : int|bool {
    if(strlen($dna1) != strlen($dna2)){
        return false;
    }
    $diff = 0;
    for($i = 0; $i < strlen($dna1); $i++){
        if($dna1[$i] != $dna2[$i]){
            $diff++;
        }
    }
    return $diff;
}