<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\ThongtinVipham */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="thongtin-vipham-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'noidung_vipham')->textInput() ?>

    <?= $form->field($model, 'quyetdinh_so')->textInput() ?>

    <?= $form->field($model, 'quyetdinh_ngay')->textInput() ?>

    <?= $form->field($model, 'hinhthuc_phat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ghi_chu')->textInput() ?>

    <?= $form->field($model, 'id_hkd')->textInput() ?>

    <?= $form->field($model, 'bienban_so')->textInput() ?>

    <?= $form->field($model, 'donvi_lap')->textInput() ?>

    <?= $form->field($model, 'donvi_qd')->textInput() ?>

    <?= $form->field($model, 'ngay_lap')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
