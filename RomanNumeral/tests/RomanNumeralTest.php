<?php

use App\RomanNumeral;
use PHPUnit\Framework\TestCase;

class RomanNumeralTest extends TestCase
{
    /**
     * @test
     * @dataProvider checks
     */
    public function it_generates_roman_numeral_for_1($number, $numeral)
    {
        $this->assertEquals($numeral, RomanNumeral::generate($number));
    }

    /** @test */
    public function it_generates_less_then_1()
    {
        $this->assertFalse(RomanNumeral::generate(0));

    }
    public function checks()
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [4, 'IV'],
            [5, 'V'],
            [6, 'VI'],
            [7, 'VII'],
            [8, 'VIII'],
            [9, 'IX'],
            [10, 'X'],
            [40, 'XL'],
            [50, 'L'],
            [90, 'XC'],
            [100, 'C'],
            [400, 'CD'],
            [500, 'D'],
            [900, 'CM'],
            [1000, 'M'],
            [3999, 'MMMCMXCIX']
        ];
    }
}
