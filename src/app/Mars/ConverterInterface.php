<?php


namespace App\Mars;


use App\Mars\FirstStep\FirstStepInterface;

interface ConverterInterface
{
    public function convert(string $input, float $j2000Offset): array;
}
