<?php

namespace App;

class Game
{
    protected array $rolls = [];
    const FRAMES__PER_GAME = 10;
    public function roll(int $pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $score = 0;
        $roll = 0;
        foreach (range(1, self::FRAMES__PER_GAME) as $frame) {
            /* Check for strike */
            if ($this->isStrike($roll)) {
                $score += $this->pinCount($roll) + $this->strikeBouns($roll);
                $roll += 1;

                continue;
            }
            $score += $this->defaultFrameScore($roll);


            if ($this->isSpare($roll)) {
                $score +=  $this->spareBouns($roll);
                $roll += 2;
                continue;
            }

            $roll += 2;
        }
        return $score;
    }
    public function isStrike($roll)
    {
        return $this->pinCount($roll) === 10;
    }
    public function isSpare($roll)
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1] === 10;
    }
    public function defaultFrameScore($roll): int
    {

        return $this->pinCount($roll) + $this->pinCount($roll + 1);
    }
    public function strikeBouns(int $roll): int
    {
        return $this->pinCount($roll + 1) + $this->pinCount($roll + 2);
    }
    public function spareBouns($roll)
    {
        return $this->pinCount($roll + 2);
    }
    public function pinCount(int $roll)
    {
        return $this->rolls[$roll];
    }
}
