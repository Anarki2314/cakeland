<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->title = Yii::$app->name;
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <header id="header">
            <div class="container-block">

                <?php
                NavBar::begin([
                    'brandLabel' => Yii::$app->name,
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => ['class' => 'navbar-expand-md'],
                    'renderInnerContainer' => false,
                    'containerOptions' => ['class' => 'justify-content-around'],
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'items' => [
                        ['label' => 'Главная', 'url' => ['/site/index']],
                        ['label' => 'Каталог', 'url' => ['/catalog/index']],

                    ]
                ]);
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-auth'],
                    'items' => [
                        Yii::$app->user->isGuest ?
                            ['label' => 'Регистрация', 'url' => ['/auth/sign-up']] : '',
                        !Yii::$app->user->isGuest && Yii::$app->user->identity->isUser ?
                            '<li class="nav-item">
                                <a class="nav-link" href="/profile/cart"><img src="/static/shopping-bag-icon.svg"></a>
                            '
                            : '',
                        !Yii::$app->user->isGuest ?
                            '<li class="nav-item">
                                <a class="nav-link" href="/profile"><img src="/static/account-icon.svg"></a>
                            '
                            : '',
                        Yii::$app->user->isGuest ?
                            '<li class="nav-item ">
                                <a class="nav-link" href="/auth/sign-in"><img src="/static/sign-in-icon.svg"></a>
                            </li>
                            '
                            : '',
                        !Yii::$app->user->isGuest ?
                            '<li class="nav-item">'
                            . Html::beginForm(['/site/logout'])
                            . Html::submitButton(
                                '<img src="/static/sign-out-icon.svg">',
                                ['class' => 'nav-link btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>' : '',
                    ]
                ]);
                NavBar::end();
                ?>
            </div>
        </header>

        <main id="main" class="flex-shrink-0 m-auto py-5" role="main">
            <?php if (!empty($this->params['breadcrumbs'])) : ?>
                <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
            <?php endif ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </main>

        <footer id="footer">
            <div class="container-block">
                <div class="container-footer justify-content-between">
                    <div class="footer-items">
                        <div class="footer-item">
                            <?= Html::a('Главная', ['/site/'], ['class' => 'footer-link']) ?>
                        </div>
                        <div class="footer-item"><?= Html::a('Каталог', ['/catalog/'], ['class' => 'footer-link']) ?>
                        </div>
                    </div>
                    <div class="footer-items">
                        <?php if (Yii::$app->user->isGuest) : ?>
                            <div class="footer-item">
                                <?= Html::a('Регистрация', ['/auth/sign-up'], ['class' => 'footer-link']) ?>
                            </div>
                            <div class="footer-item">
                                <?= Html::a('Регистрация для кондитеров', ['/auth/confectioner-sign-up'], ['class' => 'footer-link']) ?>
                            </div>
                            <div class="footer-item">
                                <?= Html::a('Авторизация', ['/auth/sign-in'], ['class' => 'footer-link']) ?>
                            </div>
                        <?php else : ?>
                            <?php if (!Yii::$app->user->identity->isAdmin) : ?>
                                <div class="footer-item">
                                    <?= Html::a('Личный кабинет', ['/account'], ['class' => 'footer-link']) ?>
                                </div>
                            <?php else : ?>
                                <div class="footer-item">
                                    <?= Html::a('Панель администратора', ['/admin'], ['class' => 'footer-link']) ?>
                                </div>
                            <?php endif ?>

                            <?php if (Yii::$app->user->identity->isUser) : ?>
                                <div class="footer-item">
                                    <?= Html::a('Корзина', ['/account/cart'], ['class' => 'footer-link']) ?>
                                </div>
                            <?php endif ?>

                        <?php endif ?>
                    </div>

                    <div class="footer-items d-none d-md-block">
                        <img src="/static/footer-img.png" class="footer-img">
                    </div>
                </div>
                <div class="copyright">
                    <p>© 2024 Cakeland. Все права защищены.</p>
                </div>
            </div>
    </div>
    </div>
    </footer>

    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>