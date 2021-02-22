<?php


namespace backend\components;


use app\models\Apple;
use yii\base\Exception;

class ForbiddenEat implements EatableInterface
{
    /**
     * @param Apple $fruit
     * @param int $part
     * @throws Exception
     */
    public function eat(Apple $fruit, int $part)
    {
        if (!$fruit->isFallen())
            throw new Exception('This apple is still growing and cannot be eaten.');
        elseif (time() - $fruit->fallAt >= $fruit::TIME_TO_SPOIL)
            throw new Exception('This apple cannot be eaten');

    }
}