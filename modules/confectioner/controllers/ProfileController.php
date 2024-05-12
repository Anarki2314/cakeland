<?php

namespace app\modules\confectioner\controllers;

use app\models\Confectioner;
use app\models\User;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `confectioner` module
 */
class ProfileController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model = User::findOne(Yii::$app->user->id);
        $confectionerModel = Confectioner::findOne(['userId' => Yii::$app->user->id]);
        $documents = $confectionerModel->getDocumentsNames();
        return $this->render('index', ['model' => $model, 'confectionerModel' => $confectionerModel, 'documents' => $documents]);
    }
}
