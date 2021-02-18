<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Apple */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Enter percentage of apple bite off:';
?>

<div class="apples-form">
    <h3><?= Html::encode($this->title) ?></h3>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['eat'],
    ]); ?>

    <div class="form-group">

        <?= Html::hiddenInput('id',Yii::$app->request->get('id'))?>

        <?= Html::input('text','part') ?>

        <?= Html::submitButton('Eat', ['class' => 'btn btn-success']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
