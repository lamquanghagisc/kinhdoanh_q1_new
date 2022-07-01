<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 9/25/2021
 * Time: 5:09 PM
 */
use yii\helpers\Html;

$module = Yii::$app->controller->module;

$this->params['breadcrumbs'][] = $module->moduleTitle;
?>


<div class="block block-themed">
    <div class="block-header">
        <h3 class="block-title"><?= $module->moduleTitle?></h3>
    </div>
    <div class="block-content">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Tên danh mục</th>
                        <th></th>
                    </tr>
                    <?php foreach($module->list_danhmuc as $i => $item):?>
                    <tr>
                        <td><?= $i + 1?></td>
                        <td><?= Html::a($item['name'],[$item['url']],[])?></td>
                        <td><?= Html::a('Chi tiết',[$item['url']],['class' => 'btn btn-sm btn-info'])?></td>
                    </tr>
                    <?php endforeach;?>
                </table>
            </div>
        </div>
    </div>
</div>
