<?php

namespace App;

use Exception;

class StringCalculator
{
    const MAX_NUMBER_ALLOWED = 1000;
    protected   $delimiter = ",|\n";
    public function add(string $numbers)
    {
        $numbers = $this->parseString($numbers);

        $this->disallowNegativeNumbers($numbers);

        return array_sum($this->ignoreGreaterThen1000($numbers));
    }

    public function disallowNegativeNumbers(array $numbers): StringCalculator
    {
        foreach ($numbers as $number) {
            if ($number < 0) throw new Exception("negative are disallowed");
        }
        return $this;
    }
    public function ignoreGreaterThen1000($numbers): array
    {
        return array_filter($numbers, fn ($number) => $number <= self::MAX_NUMBER_ALLOWED); // the maximum number you are allowed);
    }


    public function parseString(string $numbers)
    {
        $customDelimiter = "\/\/(.)\n";
        if (preg_match("/$customDelimiter/", $numbers, $matches)) {
            $this->delimiter = $matches[1];
            $numbers = str_replace($matches[0], '', $numbers); //[5,4]

        }
        // $numbers=explode(',',$numbers);
        return preg_split("/$this->delimiter/", $numbers); //it can be , or \n

    }
}
