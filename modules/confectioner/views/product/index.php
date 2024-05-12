<?php

use app\models\Product;
use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

// $this->registerCssFile('@web/css/form.css', ['depends' => [BootstrapAsset::class]]);
$this->registerCssFile('@web/css/table.css', ['depends' => [BootstrapAsset::class]]);
/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Все товары';
?>
<div class="product-index">

    <h1 class="title text-center"><?= Html::encode($this->title) ?></h1>

    <p class="mb-5">
        <?= Html::a('Добавить товар', ['create'], ['class' => 'button-view button-main-dark']) ?>
    </p>
    <div class="container-block">

        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); 
        ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'summary' => false,

            'columns' => [

                'id',
                'title',
                [
                    'attribute' => 'price',
                    'value' => function ($model) {
                        return $model->price . ' ₽';
                    }
                ],
                [
                    'attribute' => 'statusId',
                    'value' => function ($model) {
                        return $model->status->title;
                    }
                ],
                [
                    'attribute' => 'quantity',
                    'value' => function ($model) {
                        return $model->quantity . ' шт.';
                    }
                ],
                //'userId',
                //'imageId',
                //'createdAt',
                [
                    'label' => 'Действия',
                    'format' => 'html',
                    'content' => function (Product $model) {
                        return '';
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>

</div>