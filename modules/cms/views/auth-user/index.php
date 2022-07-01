<?php

use app\modules\cms\models\AuthUserSearch;
use johnitvn\ajaxcrud\CrudAsset;
use app\widgets\gridview\GridView;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel AuthUserSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Auth Users';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>
<div class="auth-user-index">
    <div id="ajaxCrudDatatable">
        <?=
        GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'toggleDataContainer' => ['class' => 'btn-group mr-4'],
            'columns' => require(__DIR__ . '/_columns.php'),
            'toolbar' => [
                ['content' =>
                    Html::a('<i class="fa fa-plus"></i> Thêm mới', Yii::$app->urlManager->createUrl(['cms/auth-user/create']), ['class' => 'btn btn-success', 'title' => 'Thêm mới']) .
                    '{export}'
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panelPrefix' => 'block ',
            'toolbarContainerOptions' => ['class' => 'float-right'],
            'summaryOptions' => ['class' => 'float-right'],
            'panel' => [
                'type' => 'block-themed',
                'headingOptions' => ['class' => 'block-header'],
                '<div class="clearfix"></div>',
            ]
        ])
        ?>
    </div>
</div>
<?php
Modal::begin([
    "id" => "ajaxCrudModal",
    "closeButton"=>FALSE,
    "footer" => "", // always need it for jquery plugin
])
?>
<?php Modal::end(); ?>
