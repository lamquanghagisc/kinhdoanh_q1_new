<?php

use yii\helpers\Html;
use app\widgets\gridview\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\auth\models\AuthGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Danh sách nhóm quyền";
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
                .'{export}'    
        ],
        
    ],
    'columns' => [
        ['class' => 'kartik\grid\SerialColumn'],
                    'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            //'status',
        ['class' => 'app\modules\contrib\grid\ActionColumn'],
    ],
]); ?>