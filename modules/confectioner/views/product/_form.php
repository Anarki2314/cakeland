<?php

use app\models\Category;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\BootstrapAsset;

$this->registerCssFile('@web/css/form.css', ['depends' => [BootstrapAsset::class]]);



/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'categoryId')->dropDownList(Category::getCategories(), ['prompt' => 'Выберите категорию...']) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 4]) ?>

    <div class="form-group text-center">
        <?= Html::submitButton('Cохранить', ['class' => 'button-view button-main-dark   ']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>