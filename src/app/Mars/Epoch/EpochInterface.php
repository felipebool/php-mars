<?php


namespace App\Mars\Epoch;


interface EpochInterface
{
    public function getJ2000TimeOffsetTT(string $time, float $leapSeconds): float;
}
