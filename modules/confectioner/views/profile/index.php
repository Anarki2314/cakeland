<?php

use app\models\OrganizationType;
use yii\bootstrap5\BootstrapAsset;

$this->title = 'Личный кабинет';
$this->registerCssFile('@web/css/profile.css', ['depends' => [BootstrapAsset::class]]);

use yii\bootstrap5\Html;

/**
 * @var $this yii\web\View
 * @var $model app\models\User
 * @var $confectionerModel app\models\Confectioner
 */
?>

<div class="confectioner-profile-index container-block">
    <h1 class="title text-center">Личный кабинет</h1>

    <div class="container-profile d-flex justify-content-center justify-content-md-between flex-wrap ">
        <div class="container-profile-info">
            <div class="profile-info-block">
                <div class="profile-info-block-item">
                    <span class="profile-info-span">ФИО: </span>
                    <span class="profile-info-text"><?= Html::encode($model->fullName) ?></span>
                </div>
                <div class="profile-info-block-item">
                    <span class="profile-info-span">Логин: </span>
                    <span class="profile-info-text"><?= Html::encode($model->login) ?></span>
                </div>
                <div class="profile-info-block-item">
                    <span class="profile-info-span">Email: </span>
                    <span class="profile-info-text"><?= Html::encode($model->email) ?></span>
                </div>
                <div class="profile-info-block-item">
                    <span class="profile-info-span">ИНН: </span>
                    <span class="profile-info-text"><?= Html::encode($confectionerModel->inn) ?></span>
                </div>
                <div class="profile-info-block-item">
                    <span class="profile-info-span">Тип организации: </span>
                    <span class="profile-info-text"><?= Html::encode(OrganizationType::getTypeById($confectionerModel->organizationType)->title) ?></span>
                </div>

            </div>

            <div class="profile-info-block">
                <div class="profile-info-block-item">
                    <span class="profile-info-span">Документы: </span>
                </div>
                <?php foreach ($documents as $document) : ?>

                    <div class="profile-info-block-item">
                        <?= Html::a(Html::encode($document['name']), ['/uploads/' . $document['name']], ['class' => 'profile-info-text', 'download' => $document['name']]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="container-profile-buttons">
            <div class="profile-button">
                <?= Html::a('Добавить товар', ['/confectioner/product/create'], ['class' => 'button-view button-main-dark']) ?>
            </div>
            <div class="profile-button  justify-content-center justify-content-md-end">
                <?= Html::a('Все товары', ['/confectioner/product/'], ['class' => 'button-view button-main-dark']) ?>
            </div>
            <div class="profile-button justify-content-center justify-content-md-end">
                <?= Html::a('Доходы', ['/confectioner/product/income'], ['class' => 'button-view button-main-dark']) ?>
            </div>
        </div>
    </div>
</div>