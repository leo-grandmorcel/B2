<?php

interface PoolTempsInterface
{
    public function getActualTemp(): int;
    public function getLastDaysTemps(): int;
    public function setHeater(bool $value) : self;
}

class PoolTemps implements PoolTempsInterface{
    public bool $isActive;
    public int $currentTemp;
    public array $avg7Temp;
    public function __construct(int $currentTemp, array $avg7Temp)
    {
        $this->isActive = false;
        $this->currentTemp = $currentTemp;
        $this->avg7Temp = $avg7Temp;
    }
    public function getActualTemp(): int {
        return $this->currentTemp;
    }
    public function getLastDaysTemps(): int {
        return array_sum($this->avg7Temp) / count($this->avg7Temp);
    }
    public function setHeater(bool $value) : self {
        $this->isActive = $value;
        return $this;
    }
    public function activateHeater(): self {
        if ($this->getLastDaysTemps()>20 && $this->getActualTemp()>=25){
            $this->setHeater(true);
        } 
        return $this;
    }
}