<?php

namespace app\controllers;

use app\models\Confectioner;
use app\models\ConfectionerFile;
use app\models\LoginForm;
use app\models\OrganizationType;
use app\models\Role;
use app\models\Status;
use app\models\User;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class AuthController extends Controller
{
    public function actions()
    {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['site/index']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignIn()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('sign-in', [
            'model' => $model,
        ]);
    }

    public function actionSignUp()
    {
        $model = new \app\models\User();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->roleId = Role::getRoleByTitle('user')->id;
                $model->save();
                // form inputs are valid, do something here
                if (Yii::$app->user->login($model)) {
                    Yii::$app->session->setFlash('success', 'Вы успешно зарегистрировались');
                    $this->redirect(['site/index']);
                }
            }
        }

        return $this->render('sign-up', [
            'model' => $model,
        ]);
    }
    public function actionConfectionerSignUp()
    {
        $model = new Confectioner();
        $userModel = new User();
        $orgTypes = OrganizationType::getTypes();
        if ($model->load(Yii::$app->request->post()) && $userModel->load(Yii::$app->request->post(), 'Confectioner')) {


            $userModel->roleId = Role::getRoleByTitle('confectioner')->id;
            $model->statusId = Status::getStatusByTitle('На модерации')->id;
            $model->documents = UploadedFile::getInstances($model, 'documents');
            if ($model->upload()) {
                $userModel->save(false);
                $model->userId = $userModel->id;
                $model->save(false);

                foreach ($model->documentsNames as $documentName) {
                    $fileModel = new ConfectionerFile();
                    $fileModel->confectionerId = $model->id;
                    $fileModel->name = $documentName;
                    $fileModel->save();
                }
                if (Yii::$app->user->login($userModel)) {
                    $this->redirect(['site/index']);
                }
                return;
            }
        }

        return $this->render('confectioner-sign-up', [
            'model' => $model,
            'orgTypes' => $orgTypes,
        ]);
    }
}
