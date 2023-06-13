<?php


function getFloor(int $currentFloor, int $requestFloor = null, array $calledFloors) : int | null {
    if ($requestFloor !== null) {
        return $requestFloor;
    }
    if (count($calledFloors) > 0) {
        $differences = array_map(function($floor) use($currentFloor) {
            return abs($floor - $currentFloor);
        }, $calledFloors);
        $min = min($differences);
        $key = array_search($min, $differences);
        return $calledFloors[$key];
    }
    return null;
}


function getDirection(int $currentFloor, int|null $requestFloor, array $calledFloors): int{
    $floor = getFloor($currentFloor, $requestFloor, $calledFloors);
    if ($floor === null) {
        return 0;
    }
    return $floor <=> $currentFloor;
}


echo getFloor(3, null, [1, 7]);