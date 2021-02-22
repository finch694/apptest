<?php

use yii\grid\ActionColumn;use yii\helpers\Html;
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

    <p>
        <?= Html::a('Create Apples', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'dd MM yy',
            'defaultTimeZone' => 'Europe/Kiev',
            'datetimeFormat' => 'php: d.m.y | H:i',
        ],
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
            [
                'attribute' => 'status.status_name',
                'label' => 'status',
//                'content' => function ($model) {
//                    return $model->status->status_name;
//                },
            ],
            [
                'attribute' => 'integrity',
                'content' => function ($model) {
                    return $model->integrity * 100 . ' %';
                }
            ],
            'createAt:datetime',
            'fallAt:datetime',
            [
                'class' => ActionColumn::class,
                'template' => '{view} {delete} {modal} {fall}',
                'buttons' => [
                    'modal' => function ($url) {
                        return Html::a('<i class="glyphicon glyphicon-apple"></i>', $url, ['class' => 'modal-eat']);
                    },
                    'fall' => function ($url) {
                        return Html::a('<i class="glyphicon glyphicon-tree-deciduous"></i>', $url);
                    }
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?= $this->render('../layouts/_modal-template', ['id' => 'modal-eat']) ?>
