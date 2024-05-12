<?php

namespace app\controllers;

use app\models\UserOrder;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class ProfileController extends Controller
{

    public function actions()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect(['site']);
        } elseif (Yii::$app->user->identity->isConfectioner) {
            $this->redirect(['confectioner/profile/']);
        } elseif (Yii::$app->user->identity->isAdmin) {
            $this->redirect(['admin']);
        }
    }
    public function actionIndex()
    {
        $model = Yii::$app->user->identity;
        $orders = new ActiveDataProvider([
            'query' => UserOrder::find()->where(['userId' => Yii::$app->user->id]),
            'sort' => ['defaultOrder' => ['createdAt' => SORT_DESC]],
        ]);
        return $this->render('index', ['model' => $model, 'orders' => $orders]);
    }
}
