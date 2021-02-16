<?php


namespace backend\components;


use app\models\Apple;
use yii\db\Exception;

class BasicEat implements EatableInterface
{

    public function eat(Apple $fruit, int $part)
    {
        if ($part/100 > $fruit->integrity){
            throw new Exception('you want to eat more then apple has');
        }
        $fruit->integrity-=$part/100;
    }
}