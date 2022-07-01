<?php

use yii\helpers\Html;
use app\widgets\gridview\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\AuthActionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Danh sách hoạt động";
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
            Html::a('<i class="fa fa-plus mr-1"></i> Tự động tạo hoạt động', ['generate'], ['class' => 'btn btn-success', 'title' => 'Tự động tạo action', 'data-pjax' => 0, 'data' => [
                'confirm' => 'Bạn có chắc muốn thực hiện thao tác này?',
                'method' => 'post',
            ],])
                . '{export}'
        ],

    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
        'name',
        // 'desciption',
        'created_at:datetime',
        //'status',
    ],
]); ?>