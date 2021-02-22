<?php


namespace backend\components;


use app\models\Apple;

class EatFactory
{
    public function detectEatBehavior(Apple $apple)
    {
        return $apple->isFallen() && time() - $apple->fallAt < $apple::TIME_TO_SPOIL ?
            new BasicEat() : new ForbiddenEat();
    }
}