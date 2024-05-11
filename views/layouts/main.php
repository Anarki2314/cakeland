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
                        !Yii::$app->user->isGuest ?
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

        <main id="main" class="flex-shrink-0" role="main">
            <div class="container">
                <?php if (!empty($this->params['breadcrumbs'])) : ?>
                    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                <?php endif ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </main>

        <footer id="footer" class="mt-auto">
            <div class="container">
                <div class="row text-muted">
                    <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
                    <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
                </div>
            </div>
        </footer>

    </div>
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>