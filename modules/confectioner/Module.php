<?php

namespace app\modules\confectioner;

/**
 * confectioner module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\confectioner\controllers';
    public $defaultRoute = 'profile/index';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
