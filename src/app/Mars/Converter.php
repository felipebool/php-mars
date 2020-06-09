<?php


namespace App\Mars;


class Converter implements ConverterInterface
{
    private function getMarsSolDateAsFloat(float $j2000Offset): float
    {
        $solDate = $j2000Offset - 4.5;
        $solDate /= 1.027491252;
        $solDate += + 44796.0;
        $solDate -= 0.00096;

        return $solDate;
    }

    private function getMarsSolDate(float $j2000Offset): string
    {
        $solDate = $this->getMarsSolDateAsFloat($j2000Offset);

        return number_format($solDate, 2, ',', '.');
    }

    private function getMartianCoordinatedTime(float $j2000Offset): string
    {
        $solDate = $this->getMarsSolDateAsFloat($j2000Offset);
        $solDate = fmod($solDate * 24, 24);

        return gmdate('H:i:s', floor($solDate * 3600));
    }

    public function convert(float $j2000Offset): array
    {
        return [
            'mars_sol_date' => $this->getMarsSolDate($j2000Offset),
            'martian_coordinated_time' => $this->getMartianCoordinatedTime($j2000Offset),
        ];
    }
}
