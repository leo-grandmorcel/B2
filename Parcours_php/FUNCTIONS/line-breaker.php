<?php

function breakLines($myString, $lengthLines) : string{
    return wordwrap($myString, $lengthLines);
}