<?php

namespace app\models;


use backend\components\EatableInterface;
use backend\components\EatFactory;
use Exception;

/**
 */
class Apple extends Apples
{
    /**
     * @var EatableInterface
     */
    private $eatBehavior;

    const TIME_TO_FALL = 10 * 3600;
    const TIME_TO_SPOIL = 5 * 3600;

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
//        var_dump($this);
//        exit();
        parent::__construct($config);
    }

    public function fall()
    {
        if ($this->status_id == 1) {
            $this->status_id = 2;
            $this->fallAt = time();
        } else {
            throw new Exception('apple is not on the tree');
        }
        $this->save();
    }

    private function accidentalFall() //TODO remake accidental fall
    {
        if ($this->status_id == 1 &&
            rand(0, self::TIME_TO_FALL) < time() - $this->createAt) {
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

    public function getColor(): string
    {
        return $this->color;
    }

    private function randomColor(): string
    {
        return sprintf('#%02X%02X%02X', rand(100, 255), rand(100, 255), '80');
    }
}
