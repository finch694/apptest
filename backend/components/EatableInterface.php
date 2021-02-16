<?php

namespace backend\components;

use app\models\Apple;

interface EatableInterface
{
    public function eat(Apple $fruit, int $part);
}
