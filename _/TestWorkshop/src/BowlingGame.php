<?php


class BowlingGame
{

    private array $throws = [];


    public function throw(int $points): void
    {
        $this->throws[] += $points;
    }

    public function getScore(): int
    {
        $score = 0;
        $throw = 0;
        for ($i = 0; $i < 10; $i++) {
            if ($this->isStrike($throw)){
                $score += $this->getStrikeScore($throw);
                $throw +=1;
                continue;
            }
            if ($this->isASpare($throw)) {
                $score += $this->getSpareBonus($throw);
            }

            $score += $this->getFrameScore($throw);
            $throw +=2;
        }

        return $score;
    }

    /**
     * @param int $throw
     * @return mixed
     */
    protected function getFrameScore(int $throw): int
    {
        return $this->throws[$throw] + $this->throws[$throw + 1];
    }

    /**
     * @param int $throw
     * @return int|mixed
     */
    protected function isASpare(int $throw): bool
    {
        return $this->getFrameScore($throw) === 10;
    }

    /**
     * @param int $throw
     * @return mixed
     */
    protected function getSpareBonus(int $throw): int
    {
        return $this->throws[$throw + 2];
    }

    /**
     * @param int $throw
     * @return bool
     */
    protected function isStrike(int $throw): bool
    {
        return $this->throws[$throw] === 10;
    }

    /**
     * @param int $throw
     * @return int|mixed
     */
    protected function getStrikeScore(int $throw): int
    {
        return 10 + $this->throws[$throw + 1] + $this->throws[$throw + 2];
    }
}