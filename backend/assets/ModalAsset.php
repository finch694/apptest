<?php


namespace backend\assets;

use yii\web\AssetBundle;

class ModalAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets';
    public $js = ['modalEat.js'];
    public $depends = [
        'yii\web\YiiAsset',
        'backend\assets\SweetAlertAsset',
        'dominus77\sweetalert2\assets\SweetAlert2Asset'
    ];
}