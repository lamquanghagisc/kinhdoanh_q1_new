<?php

use app\modules\contrib\widgets\DualListboxWidget;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\AuthGroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhóm quyền', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>

<div class="card">
    <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div class="text-uppercase">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="header-buttons">
            <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Bạn có chắc muốn xóa mục này?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </h5>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'name',
                'description',
                'created_at:datetime',
                'updated_at:datetime',
                // 'status',
                [
                    'attribute' => 'roleIds',
                    'value' => function ($model) {
                        $value = "<ol class='pl-3'>";
                        foreach ($model->roles as $role) {
                            $value .= "<li>{$role->name}</li>";
                        }
                        $value .= "</ol>";
                        return $value;
                    },
                    'format' => 'raw'
                ]
            ],
        ]) ?>
    </div>
</div>