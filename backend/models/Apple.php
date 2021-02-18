<?php

namespace app\models;


use backend\components\EatableInterface;
use backend\components\EatFactory;

/**
 */
class Apple extends Apples
{
    /**
     * @var EatableInterface
     */
    private $eatBehavior;

    private const TIME_TO_FALL = 10;
    private const BASIC_CHANCE_TO_FALL = 0.1;

    /**
     * @return bool
     */
    public function isFallen()
    {
        return $this->fallAt + 5 * 3600 >= time() && $this->status_id === 2;
    }

    public function __construct($config = [])
    {
        $this->color = $this->randomColor();
        $this->status_id = 1;
        parent::__construct($config);
    }

    public function fall()
    {
        $this->status_id = 2;
        $this->fallAt = time();
        $this->save();
    }

    public function accidentalFall()
    {
        if (rand(0, time() - $this->createAt) < self::TIME_TO_FALL * 3600 * self::BASIC_CHANCE_TO_FALL) {
            $this->fall();
        }
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->accidentalFall();
        $this->eatBehavior = (new EatFactory())->detectEatBehavior($this);
    }

    public function eat(int $part)
    {
        $this->eatBehavior->eat($this, $part);
        if ($this->integrity == 0) {
            $this->delete();
        } else {
            $this->save();
        }
    }


    public function getColor()
    {
        return $this->color;
    }

    private function randomColor()
    {
        return sprintf('#%02X%02X%02X', rand(100, 255), rand(100, 255), '80');
    }
}
