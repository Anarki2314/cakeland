<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->registerCssFile('css/auth.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->registerCssFile('css/form.css', ['depends' => [\yii\bootstrap5\BootstrapAsset::class]]);
$this->title = 'Авторизация';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- <p>Please fill out the following fields to login:</p> -->

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group text-center">
                <div>
                    <?= Html::submitButton('Авторизоваться', ['class' => 'button-view button-main-dark', 'name' => 'login-button']) ?>
                </div>
            </div>

            <div class="auth-links">
                <p>У вас нет аккаунта? <?= Html::a('Зарегистрироваться', ['/auth/sign-up'], ['class' => 'auth-link']) ?></p>

                <?php ActiveForm::end(); ?>


            </div>
        </div>
    </div>