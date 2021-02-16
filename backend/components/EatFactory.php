<?php


namespace backend\components;


use app\models\Apple;

class EatFactory
{
    public function detectEatBehavior(Apple $apple)
    {
        return $apple->isFallen() && $apple->integrity > 0 ? new BasicEat() : new ForbiddenEat();
    }

}