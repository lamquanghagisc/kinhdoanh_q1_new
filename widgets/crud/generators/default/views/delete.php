<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 5/31/2021
 * Time: 12:35 AM
 */
use kartik\form\ActiveForm;
?>
<?php $form = ActiveForm::begin()?>
<h4>Xóa <?= $generator->title?> "<?= '<?=$model->ten?>'?>"?</h4>
<?php ActiveForm::end()?>