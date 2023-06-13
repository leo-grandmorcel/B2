<?php

class Magic{
    public function __construct(){
       $this->card = "As";
    }
    public function __destruct(){}
    public function __get( $allo){}
    public function __set( $allo, $value){}
    public function __isset($allo){}
    public function __toString(){}
    public string $card;
}