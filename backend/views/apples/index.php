<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\assets\ModalAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApplesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

ModalAsset::register($this);
$this->title = 'Apples';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apples-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Apples', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'color',
                'label' => 'color',
                'content' => function ($model) {
                    return Html::tag(
                        'div',
                        '',
                        [
                            'style' =>
                                [
                                    "background-color" => $model->color,
                                    'width' => '20px',
                                    'height' => '20px'
                                ]
                        ]
                    );
                }
            ],
//            'status_id',
            [
                'attribute' => 'status_id',
                'label' => 'status',
                'content' => function ($model) {
//                    var_dump($model->status->status_name);
                    return $model->status->status_name;
                },
            ],
//            'integrity',
            [
                'attribute' => 'integrity',
                'content' => function ($model) {
                    return $model->integrity * 100 . ' %';
                }
            ],
            'createAt:datetime',
            'fallAt:datetime',
//sweetalert
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} {modal} {fall}',
                'buttons' => [
                    'modal' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-apple"></i>', $url, ['class' => 'modal-eat']);
                    },
                    'fall' => function ($url, $model, $key) {
                        return Html::a('<i class="glyphicon glyphicon-tree-deciduous"></i>', $url);
                    }
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<div class="modal fade bd-example-modal-sm" id="modal-eat" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Enter percentage of apple bite off:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                </form>
                <button type="button" class="btn btn-primary">Bite off</button>
            </div>
        </div>
    </div>
</div>
