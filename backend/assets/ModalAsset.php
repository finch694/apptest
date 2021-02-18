<?php


namespace backend\assets;

use yii\web\AssetBundle;

class ModalAsset extends AssetBundle
{
    public $sourcePath = '@backend/assets';
    public $js = ['modalEat.js'];
    public $depends = ['yii\web\YiiAsset'];
}