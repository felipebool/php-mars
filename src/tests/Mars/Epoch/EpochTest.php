<?php

namespace Mars\Epoch;

use App\Mars\Epoch\Epoch;
use App\Mars\Epoch\EpochInterface;
use PHPUnit\Framework\TestCase;

class EpochTest extends TestCase
{
    private EpochInterface $epoch;

    protected function setUp(): void
    {
        $this->epoch = new Epoch();
        parent::setUp();
    }

    /**
     * @param string $date
     * @param float $leapSeconds
     * @param float $expected
     *
     * @dataProvider provider
     */
    public function testGetJ2000TimeOffsetTT(string $date, float $leapSeconds, float $expected)
    {
        $result = $this->epoch->getJ2000TimeOffsetTT($date, $leapSeconds);
        $this->assertEquals($expected, $result);
    }

    public function provider(): array
    {
        return [
            ['Tuesday, 9 June 2020, 13:01:16 CEST', 10, 7464.9593287036],
            ['Tuesday, 9 June 2020, 13:01:16 CEST', 0, 7464.959212963004],
            ['Friday, 9 June 1971, 13:01:16 CEST', 0, -10431.040787036996]
        ];
    }
}
