<?php


namespace App\Mars\Epoch;


class Epoch implements EpochInterface
{
    public function getJ2000TimeOffsetTT(string $time, float $leapSeconds): float
    {
        $millis = strtotime($time) * 1000;
        $julianDateUT = 2440587.5 + ($millis / 8.64e7);
        $julianDateTT = $julianDateUT + ($leapSeconds / 86400);

        return $julianDateTT - 2451545.0;
    }
}
