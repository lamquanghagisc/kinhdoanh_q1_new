<?php

namespace app\modules\auth\controllers;

use Yii;
use app\modules\auth\models\AuthRole;
use app\modules\auth\models\AuthRoleSearch;
use app\modules\auth\models\form\AuthRoleForm;
use app\modules\auth\services\AuthActionService;
use app\modules\auth\services\AuthRoleService;
use app\modules\auth\services\AuthService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthRoleController implements the CRUD actions for AuthRole model.
 */
class AuthRoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all AuthRole models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthRoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthRole model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AuthRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthRoleForm();

        if (AuthRoleService::create($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Thêm mới thành công');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $actions = AuthActionService::getAll();

        return $this->render('create', compact('model', 'actions'));
    }

    /**
     * Updates an existing AuthRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->loadActionIds();

        if (AuthRoleService::update($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Cập nhật thành công');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $actions = AuthActionService::getAll();

        return $this->render('update', compact('model', 'actions'));
    }

    /**
     * Deletes an existing AuthRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (AuthRoleService::delete($model)) {
            Yii::$app->session->setFlash('success', 'Xóa thành công');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthRoleForm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthRoleForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
