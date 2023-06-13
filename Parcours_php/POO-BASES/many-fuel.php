<?php

class Car
{
    private float $tank;


    public function __construct(float $tank = 0)
    {
        $this->tank = $tank;
    }
    public function getTank() : float {
        return $this->tank;
    }
    public function setTank(float $gallon) : self {
        $this->tank += $gallon;
        return $this;
    }
    public function ride(float $kiloMeters) : self {
        $this-> tank -= $kiloMeters / 20 ;
        return $this;
    }
}