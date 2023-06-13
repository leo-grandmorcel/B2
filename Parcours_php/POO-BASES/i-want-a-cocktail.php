<?php

  class Mojito
  {
      public float $alcoholRate;
      public array $ingredients;
      public int $price;

      public function __construct()
      {
         $this->alcoholRate =0.15;
         $this->ingredients = Array('rum','lime', 'sparkling water', 'mint', 'sugar');
         $this->price = 8;
      }
  }