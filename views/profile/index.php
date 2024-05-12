<?php

use app\models\OrganizationType;
use app\models\UserOrder;
use yii\bootstrap5\BootstrapAsset;

$this->title = 'Личный кабинет';
$this->registerCssFile('@web/css/profile.css', ['depends' => [BootstrapAsset::class]]);
$this->registerCssFile('@web/css/table.css', ['depends' => [BootstrapAsset::class]]);
$this->registerCssFile('@web/css/product.css', ['depends' => [BootstrapAsset::class]]);



use yii\bootstrap5\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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

            </div>

        </div>


    </div>
    <div class="container-orders">
        <h2 class="title text-center">Мои заказы</h2>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $orders,
        // 'filterModel' => $searchModel,
        'summary' => false,

        'columns' => [

            'id',
            //'userId',
            //'imageId',
            //'createdAt',
            [
                'label' => 'Действия',
                'format' => 'html',
                'content' => function (UserOrder $model) {
                    return "<div class='container-table-buttons'>"
                        . Html::a(Html::img('@web/static/info-icon.svg'), ['product/view', 'id' => $model->id], ['class' => 'button-icon info'])
                        .
                        "</div>";
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>