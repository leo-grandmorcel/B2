<?php

class Geolocation
{
    public static function fromGeoPoints(float $lat1, float $long1, float $lat2, float $long2)
    {
        $earthRadius = 6371;
        $dLat = deg2rad($lat2 - $lat1);
        $dLong = deg2rad($long2 - $long1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLong / 2) * sin($dLong / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;
        return round($distance,1);
    }
}