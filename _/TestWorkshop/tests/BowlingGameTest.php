<?php

require_once 'src/BowlingGame.php';

class BowlingGameTest extends \PHPUnit\Framework\TestCase
{
    //test{methodName_{conditions}_{expectedResult} - PF testa nosaukuma konvencija
    public function testGetScore_withAll0_resultIs0()
    {
        $game = new BowlingGame();
        for ($i = 0; $i < 20; $i++){
            $game->throw(0);
        }

        $result = $game->getScore();

        self::assertEquals(0, $result);
    }

    public function testGetScore_withAll1_resultIs20()
    {
        $game = new BowlingGame();
        for ($i = 0; $i < 20; $i++){
            $game->throw(1);
        }

        $result = $game->getScore();

        self::assertEquals(20, $result);
    }

    public function testGetScore_withASpare_returnsScoreWithSpareBonus()
    {
        $game = new BowlingGame();

        $game->throw(3);
        $game->throw(7);
        $game->throw(5);

        for ($i = 0; $i < 17; $i++){
            $game->throw(1);
        }

        //3+7+5+5+17
        $result = $game->getScore();

        self::assertEquals(37, $result);
    }

    public function testGetScore_withAStrike_returnsScoreWithStrikeBonus()
    {
        $game = new BowlingGame();

        $game->throw(10);
        $game->throw(4);
        $game->throw(4);

        for ($i = 0; $i < 16; $i++){
            $game->throw(1);
        }

        //10+4+4+4+4+16
        $result = $game->getScore();

        self::assertEquals(42, $result);
    }
}