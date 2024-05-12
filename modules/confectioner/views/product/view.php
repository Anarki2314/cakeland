<?php

use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->registerCssFile('@web/css/product.css', ['depends' => [BootstrapAsset::class]]);
/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <div class="container-block">
        <h1 class="title"><?= Html::encode($this->title . ' №' . $model->id) ?></h1>

        <div class="product-info-items">

            <div class="product-info-item">
                <span class="product-info-span">Статус: </span>
                <span class="product-info-text"><?= Html::encode($model->status->title) ?></span>
            </div>
            <div class="product-info-item">
                <span class="product-info-span">Название товара: </span>
                <span class="product-info-text"><?= Html::encode($model->title) ?></span>
            </div>

            <div class="product-info-item">
                <span class="product-info-span">Количество: </span>
                <span class="product-info-text"><?= Html::encode($model->quantity . ' шт.') ?></span>
            </div>

            <div class="product-info-item">
                <span class="product-info-span">Цена: </span>
                <span class="product-info-text"><?= Html::encode($model->price . ' ₽') ?></span>
            </div>
            <div class="product-info-item">
                <span class="product-info-span">Категория: </span>
                <span class="product-info-text"><?= Html::encode($model->category->title) ?></span>
            </div>
            <div class="product-info-item">
                <span class="product-info-span">Описание: </span>
                <p class="product-info-text description"><?= Html::encode($model->description) ?></p>
            </div>


            <div class="product-info-item">
                <span class="product-info-span">Фотография: </span>
                <?= Html::img('@web/uploads/' . $model->image->name, ['class' => 'product-img', 'width' => '360', ['alt' => $model->title]]) ?>

            </div>

        </div>


    </div>