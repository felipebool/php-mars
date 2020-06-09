<?php

namespace Mars\LeapSeconds;

use App\Mars\LeapSeconds\LeapSeconds;
use App\Mars\LeapSeconds\LeapSecondsInterface;
use PHPUnit\Framework\TestCase;

class LeapSecondsTest extends TestCase
{
    private LeapSecondsInterface $leapSeconds;

    public function setUp(): void
    {
        $this->leapSeconds = new LeapSeconds();

        parent::setUp();
    }

    /**
     * @param string $date
     * @param float $expected
     *
     * @dataProvider provider
     */
    public function testLeapSeconds(string $date, float $expected)
    {
        $result = $this->leapSeconds->getLeapSecondsSince($date);

        $this->assertEquals($expected, $result);
    }

    public function provider()
    {
        return [
            ['Friday, 9 June 1971, 13:01:16 CEST', 0],
            ['Tuesday, 9 June 2020, 13:01:16 CEST', 68.184],
        ];
    }
}
