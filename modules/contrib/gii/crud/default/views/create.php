<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString('Thêm mới ' . mb_strtolower($generator->modelName)) ?>;
$this->params['breadcrumbs'][] = ['label' => '<?= $generator->modelName ?>', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-body">

    <h5><?= "<?= " ?>Html::encode($this->title) ?></h5>

    <?= "<?= " ?>$this->render('_form', [
    'model' => $model,
    ]) ?>

</div>