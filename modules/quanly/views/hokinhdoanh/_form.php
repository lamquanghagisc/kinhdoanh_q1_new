<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\HoKinhDoanh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ho-kinh-doanh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ten_hkd')->textInput() ?>

    <?= $form->field($model, 'dien_thoai')->textInput() ?>

    <?= $form->field($model, 'fax')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'nganh_nghe')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'website')->textInput() ?>

    <?= $form->field($model, 'von_kd')->textInput() ?>

    <?= $form->field($model, 'dai_dien')->textInput() ?>

    <?= $form->field($model, 'dan_toc')->textInput() ?>

    <?= $form->field($model, 'ngay_sinh')->textInput() ?>

    <?= $form->field($model, 'quoc_tich')->textInput() ?>

    <?= $form->field($model, 'cmnd')->textInput() ?>

    <?= $form->field($model, 'ngay_cap')->textInput() ?>

    <?= $form->field($model, 'noi_cap')->textInput() ?>

    <?= $form->field($model, 'hokhau_thuongtru')->textInput() ?>

    <?= $form->field($model, 'noisong_hientai')->textInput() ?>

    <?= $form->field($model, 'so_nha')->textInput() ?>

    <?= $form->field($model, 'ten_duong')->textInput() ?>

    <?= $form->field($model, 'ten_phuong')->textInput() ?>

    <?= $form->field($model, 'vi_tri')->textInput() ?>

    <?= $form->field($model, 'giayphep_so')->textInput() ?>

    <?= $form->field($model, 'ghi_chu')->textInput() ?>

    <?= $form->field($model, 'tinh_trang')->textInput() ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'id_nn')->textInput() ?>

    <?= $form->field($model, 'giayphep_ngay')->textInput() ?>

    <?= $form->field($model, 'ten_quan')->textInput() ?>

    <?= $form->field($model, 'gioi_tinh')->textInput() ?>

    <?= $form->field($model, 'tu_ngay')->textInput() ?>

    <?= $form->field($model, 'den_ngay')->textInput() ?>

    <?= $form->field($model, 'ma_thue')->textInput() ?>

    <?= $form->field($model, 'nha')->textInput() ?>

    <?= $form->field($model, 'cap1')->textInput() ?>

    <?= $form->field($model, 'cap2')->textInput() ?>

    <?= $form->field($model, 'cap3')->textInput() ?>

    <?= $form->field($model, 'cap4')->textInput() ?>

    <?= $form->field($model, 'cap5')->textInput() ?>

    <?= $form->field($model, 'tinhtrang_thue')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
