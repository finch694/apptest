<?php


namespace backend\components;


use app\models\Apple;
use yii\base\Exception;

class ForbiddenEat implements EatableInterface
{

    public function eat(Apple $fruit, int $part)
    {
        throw new Exception('НЕЛЬЗЯ!');
    }
}