<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\qldanhmuc\models\DmNganhnghe */
?>
<div class="dm-nganhnghe-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_nn',
            'ten_nganh',
            'ghi_chu',
        ],
    ]) ?>

</div>
