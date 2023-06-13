<?php

function searchWord(array $board,string $word){
    $splitWord = str_split($word);
    $cpt = 0;
    if (array_unique($splitWord) !== $splitWord) {
        return false;
    }
    $board = array_merge(...$board);
    foreach($splitWord as $letter){
        if (in_array($letter, $board)) {
            $cpt += 1;
        }
    }
    if ($cpt === strlen($word)) {
        return true;
    }
}
