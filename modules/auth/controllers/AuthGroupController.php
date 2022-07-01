<?php

namespace app\modules\auth\controllers;

use Yii;
use app\modules\auth\models\AuthGroup;
use app\modules\auth\models\AuthGroupSearch;
use app\modules\auth\models\form\AuthGroupForm;
use app\modules\auth\services\AuthGroupService;
use app\modules\auth\services\AuthRoleService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthGroupController implements the CRUD actions for AuthGroup model.
 */
class AuthGroupController extends Controller
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
     * Lists all AuthGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthGroup model.
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
     * Creates a new AuthGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthGroupForm();

        if (AuthGroupService::create($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Thêm mới thành công!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $roles = AuthRoleService::getAll();
        return $this->render('update', compact('model', 'roles'));
    }

    /**
     * Updates an existing AuthGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->loadRoleIds();
        if (AuthGroupService::update($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Cập nhật thành công!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $roles = AuthRoleService::getAll();
        return $this->render('update', compact('model', 'roles'));
    }

    /**
     * Deletes an existing AuthGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (AuthGroupService::delete($model)) {
            Yii::$app->session->setFlash('success', 'Xóa thành công!');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthGroupForm::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
