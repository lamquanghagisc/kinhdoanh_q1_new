<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\auth\models\Authaction */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Quyền truy cập', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="card">
    <h5 class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div class="text-uppercase">
            <?= $this->title ?>
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
                'desciption',
                'created_at',
                'updated_at',
                [
                    'attribute' => 'actionIds',
                    'value' => function ($model) {
                        $value = "<ol class='pl-3'>";
                        foreach ($model->actions as $action) {
                            $value .= "<li>{$action->name}</li>";
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