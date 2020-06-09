<?php


namespace App\Mars;


interface ConverterInterface
{
    public function convert(float $j2000Offset): array;
}
