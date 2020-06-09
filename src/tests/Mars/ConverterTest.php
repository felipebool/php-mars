<?php

namespace Mars;

use App\Mars\Converter;
use App\Mars\ConverterInterface;
use PHPUnit\Framework\TestCase;

class ConverterTest extends TestCase
{
    private ConverterInterface $converter;

    protected function setUp(): void
    {
        $this->converter = new Converter();
        parent::setUp();
    }

    /**
     * @param float $j2000
     * @param string $msd
     * @param string $mtc
     *
     * @dataProvider provider
     */
    public function testConverter(float $j2000, string $msd, string $mtc)
    {
        $result = $this->converter->convert($j2000);

        $this->assertArrayHasKey('mars_sol_date', $result);
        $this->assertArrayHasKey('martian_coordinated_time', $result);

        $this->assertIsArray($result);

        $this->assertEquals($msd, $result['mars_sol_date']);
        $this->assertEquals($mtc, $result['martian_coordinated_time']);
    }

    public function provider()
    {
        return [
            [7464.9593287036, '52.056,85', '20:21:52'],
            [7464.9600021299, '52.056,85', '20:22:49']
        ];
    }

}
