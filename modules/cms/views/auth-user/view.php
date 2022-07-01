<?php

use yii\widgets\DetailView;


$this->title = 'Thông tin chi tiết ';
$this->params['breadcrumbs'][] = ['label' => 'Tài khoản người dùng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-user-view">
    <div class="block block-themed">
        <div class="block-header">
            <h3 class="block-title text-uppercase">
                <?= $this->title ?>
            </h3>

            <div class="block-options">
                <a class="btn btn-warning"
                   href="<?= Yii::$app->urlManager->createUrl(['cms/auth-user/update', 'id' => $model->id]) ?>">Cập
                    nhật</a>
                <a class="btn btn-success"
                   href="<?= Yii::$app->urlManager->createUrl(['cms/auth-user/create']) ?>">Thêm mới</a>
            </div>
        </div>
       
        <div class="block-content tab-content padding-tb-05">
           
                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'username',
                        'fullname',
                        'status',
                        'active',
                        'confirmed'
                    ],
                ])
                ?>
          
            <div class="row">
                <div class="col-lg-12">
                    <a href="<?= Yii::$app->urlManager->createUrl(['cms/auth-user']) ?>"
                       class="btn btn-light float-right"><i class="fa fa-arrow-left"></i> Quay lại</a>
                </div>
            </div>
        </div>
    </div>

</div>

