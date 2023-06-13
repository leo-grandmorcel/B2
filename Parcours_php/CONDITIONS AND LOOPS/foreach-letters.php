<?php

foreach (range('A','Z') as $letter) {if ($letter == 'Z') {echo $letter;} else {echo $letter . ' | ';
    }
}