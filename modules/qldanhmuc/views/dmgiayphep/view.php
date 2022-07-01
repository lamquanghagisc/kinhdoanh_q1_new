<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\DmGiayphep */
?>
<div class="dm-giayphep-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_gp',
            'ten_gp',
            'ghi_chu',
        ],
    ]) ?>

</div>
