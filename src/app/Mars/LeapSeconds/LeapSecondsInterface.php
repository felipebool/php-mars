<?php


namespace App\Mars\LeapSeconds;


interface LeapSecondsInterface
{
    public function getLeapSecondsSince(string $time): float;
}
