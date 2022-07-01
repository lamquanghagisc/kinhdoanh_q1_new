<?php

namespace app\modules\cms\controllers;

use app\modules\auth\services\AuthService;
use app\modules\cms\models\AuthChangePass;
use app\modules\cms\models\AuthUpdatePass;
use app\modules\cms\models\AuthUser;
use app\modules\cms\models\AuthUserSearch;
use app\modules\cms\services\AuthUserService;
use app\modules\quanly\controllers\BaseController;
use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * AuthUserController implements the CRUD actions for AuthUser model.
 */
class AuthUserController extends Controller {

    /**
     * Lists all AuthUser models.
     * @return mixed
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new AuthUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthUser model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        $request = Yii::$app->request;
        $model = AuthUserService::View($id);
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new AuthUser model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $request = Yii::$app->request;
        $model = new AuthUser();
        $groups = AuthService::getAllGroups();
        $userGroups = [];
        /*
         *   Process for non-ajax request
         */
        if ($request->isPost) {
            //  dd($request->post('roles'));
            $message = AuthUserService::Create($model, $request->post());
            if ($message === true) {
                if ($request->post('roles') != NULL) {
                    $assign = AuthService::assign($model->id, $request->post('roles'));
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', $message);
                return $this->redirect(['create']);
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'groups' => $groups,
                    'userGroups' => $userGroups,
        ]);
    }

    /**
     * Updates an existing AuthUser model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $groups = AuthService::getAllGroups();
        $userGroups = ArrayHelper::getColumn(AuthService::getGroupsByUserId($id), 'id');
        // dd($userGroups);
        /*
         *   Process for non-ajax request
         */
        if ($request->isPost) {
            $message = AuthUserService::Update($model, $request->post());
            if ($message === true) {
                if ($request->post('roles') != NULL) {
                    $assign = AuthService::assign($model->id, $request->post('roles'));
                }
                 return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', $message);
                return $this->redirect(['update', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
                    'groups' => $groups,
                    'userGroups' => $userGroups,
        ]);
    }

    /**
     * Delete an existing AuthUser model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) { {
            $model = $this->findModel($id);
            if (AuthUserService::Delete($model)) {
                Yii::$app->session->setFlash('success', 'Xóa thành công');
            }
            return $this->redirect(['index']);
        }
    }

    /**
     * Active an existing AuthUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActive($id) {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            if ($request->isGet) {
                return [
                    'title' => "Kích hoạt tài khoản #" . $id,
                    'content' => $this->renderAjax('active', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-light float-right', 'data-dismiss' => "modal"]) .
                    Html::submitButton('Lưu', ['class' => 'btn btn-danger'])
                ];
            } else if (AuthUserService::Active($model, $request->post())) {
             
                return [
                     'forceReload' => '#crud-datatable-pjax',
                    'content' => '<span class="text-success">Cập nhật thành công!</span>',
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-light float-right', 'data-dismiss' => "modal"])
                ];
            }
        }
    }

    /**
     * Updates password.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionChangePass() {
        $request = Yii::$app->request;
        $model['tai-khoan'] = AuthUser::find()->where(['id' => Yii::$app->user->id])->one();
        $model['doimatkhau'] = new AuthChangePass();
        if ($request->isPost && $model['doimatkhau']->load($request->post())) {
            if ($model['doimatkhau']->changePassword() == TRUE) {
                Yii::$app->session->setFlash('success', "Đã cập nhật mật khẩu");
                return $this->redirect(Yii::$app->urlManager->createUrl('cms/auth-user/change-pass'));
            } else {
                Yii::$app->session->setFlash('success', "Cập nhật thất bại!");
                return $this->redirect(Yii::$app->urlManager->createUrl('cms/auth-user/change-pass'));
            }
        }
        return $this->render('change-pass', [
                    'model' => $model
        ]);
    }
     /**
     * Updates password.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdatePass($id) {
        $request = Yii::$app->request;
        $model['tai-khoan'] = AuthUser::find()->where(['id' => $id])->one();
        $model['doimatkhau'] = new AuthUpdatePass();
        if ($request->isPost && $model['doimatkhau']->load($request->post())) {
            if ($model['doimatkhau']->updatePassword($model['tai-khoan']) == TRUE) {
                Yii::$app->session->setFlash('success', "Đã cập nhật mật khẩu");
              return $this->redirect(['view', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('danger', "Cập nhật thất bại!");
                 return $this->redirect(['update-pass', 'id' => $id]);
            }
        }
        return $this->render('update-pass', [
                    'model' => $model
        ]);
    }

    /**
     * Finds the AuthUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = AuthUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
