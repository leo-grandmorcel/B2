<?php

abstract class AbstractGeometry {
    abstract public function area() : float | int ;
    abstract public function perimeter() : int ;
}

class Rectangle extends AbstractGeometry {
    public int $width;
    public int $height;

    public function __construct(int $width, int $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
    public function area() : float | int {
        return $this->width * $this->height;
    }
    public function perimeter() : int {
        return 2 * ($this->width + $this->height);
    }
}

class Square extends AbstractGeometry {
    public int $side;

    public function __construct(int $side)
    {
        $this->side = $side;
    }
    public function area() : int | float {
        return $this->side * $this->side;
    }
    public function perimeter() : int {
        return 4 * $this->side;
    }
}

class Triangle extends AbstractGeometry {
    public int $base;
    public int $side1;
    public int $side2;

    public function __construct(int $base, int $side1, int $side2)
    {
        $this->base = $base;
        $this->side1 = $side1;
        $this->side2 = $side2;
    }
    public function area() : float | int {
        $s = this->perimeter() / 2;
        return sqrt($s * ($s - $this->base) * ($s - $this->side1) * ($s - $this->side2));
    }
    public function perimeter() : int {
        return $this->base + $this->side1 + $this->side2;
    }
}