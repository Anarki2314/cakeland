<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = 'Создание товара';
?>
<div class="product-create">

    <h1 class="title text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>