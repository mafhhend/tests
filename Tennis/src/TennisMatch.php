<?php

namespace App;

class TennisMatch
{
    protected Player $playerOne;
    protected Player $playerTwo;

    public function __construct(Player $playerOne, Player $playerTwo)
    {
        $this->playerOne = $playerOne;
        $this->playerTwo = $playerTwo;
    }
    public function score()
    {
        if ($this->hasWinner()) {
            return "Winner: " . $this->leader()->name;
        }

        if ($this->hasAdvantage()) {
            return "Advantage: " . $this->leader()->name;
        }
        if ($this->isDeuce()) {
            return "deuce";
        }

        /* Check if we have a winner */
        return sprintf(
            "%s-%s",
            $this->playerOne->toTerm(),
            $this->playerTwo->toTerm(),
        );
    }

    public function hasAdvantage()
    {

        if ($this->canBeWon()) return !$this->isDeuce();

        return false;
    }

    public function canBeWon()
    {
        return $this->playerOne->points >= 3 && $this->playerTwo->points >= 3;
    }
    public function leader(): Player
    {
        return $this->playerOne->points > $this->playerTwo->points ? $this->playerOne : $this->playerTwo;
    }
    public function pointTo(Player $player)
    {
        $player->score();
    }
    public function hasWinner(): bool
    {
        if (max([$this->playerOne->points, $this->playerTwo->points]) < 4) {
            return false;
        }
        return abs($this->playerOne->points - $this->playerTwo->points) >= 2;
        return ($this->playerOne->points >= $this->playerTwo->points + 2
         || $this->playerTwo->points >= $this->playerOne->points + 2);
    }
    public function isDeuce(): bool
    {
        return  $this->canBeWon() && $this->playerOne->points === $this->playerTwo->points;
    }
}
