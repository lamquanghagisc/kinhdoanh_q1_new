<?php

use app\widgets\gridview\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\AuthRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách quyền truy cập';
$this->params['breadcrumbs'][] = $this->title;
?>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'pjax' => true,
    'striped' => true,
    'condensed' => true,
    'responsive' => true,
    'panel' => [
        'type' => 'primary',
        'heading' => $this->title,
    ],
    'toolbar' => [
        [
            'content' =>
            Html::a('<i class="fa fa-plus mr-1"></i> Thêm mới', ['create'], ['class' => 'btn btn-success', 'title' => 'Thêm mới', 'data-pjax' => 0])
                .  '{export}'
        ],

    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],

        'name',
        'desciption',
        'created_at',
        'updated_at',

        ['class' => 'app\modules\contrib\grid\ActionColumn'],
    ],
]); ?>