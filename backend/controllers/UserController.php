<?php

namespace backend\controllers;

use core\forms\user\UserRoleForm;
use core\services\UserService;
use Yii;
use core\entities\User;
use backend\forms\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    private UserService $userService;

    public function __construct($id, $module, UserService $userService, $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRole($id)
    {
        $user = $this->findModel($id);
        $form = new UserRoleForm($user);
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->userService->changeRole($user->id, $form->role);
                return $this->redirect(['index']);
            }catch(\Exception $e){
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }
        return $this->render('role', [
            'user' => $user,
            'model' => $form,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
