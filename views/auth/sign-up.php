<?php

use yii\bootstrap5\BootstrapAsset;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
$this->registerCssFile('css/auth.css', ['depends' => [BootstrapAsset::class]]);
$this->registerCssFile('css/form.css', ['depends' => [BootstrapAsset::class]]);
$this->title = 'Регистрация';
?>
<div class="auth-sign-up">

    <div class="container-block">

        <h1 class="title text-center">Регистрация</h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'fullName', ['options' => ['class' => 'input-container']]) ?>
        <?= $form->field($model, 'login', ['options' => ['class' => 'input-container']]) ?>
        <?= $form->field($model, 'email', ['options' => ['class' => 'input-container']]) ?>
        <div class="d-flex justify-content-between container-passwords">

            <?= $form->field($model, 'password', ['options' => ['class' => 'input-container ']])->passwordInput() ?>
            <?= $form->field($model, 'passwordRepeat', ['options' => ['class' => 'input-container ']])->passwordInput() ?>
        </div>
        <?= $form->field($model, 'terms', ['options' => ['class' => 'checkbox']])->checkbox() ?>

        <div class="form-group text-center">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'button-view button-main-dark']) ?>
        </div>
        <div class="auth-links">
            <p> <?= Html::a('Зарегистрироваться как кондитер', ['/auth/confectioner-sign-up'], ['class' => 'auth-link']) ?></p>
            <p>У вас уже есть аккаунт? <?= Html::a('Войти', ['/auth/sign-in'], ['class' => 'auth-link']) ?></p>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

</div><!-- auth-sign-up -->