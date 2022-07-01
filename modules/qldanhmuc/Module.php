<?php

/**
 * Description of Module
 *
 * @author admin
 */

namespace app\modules\qldanhmuc;

use app\modules\cms\services\AuthService;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class Module extends \yii\base\Module
{
    public $moduleTitle = 'Quản lý danh mục';
    public $moduleName = 'qldanhmuc';
    public $list_danhmuc;

    public function init()
    {
        $this->list_danhmuc = [
             
            'giayphep' => [
                'name' => 'Giấy phép liên quan',
                'url' => 'dmgiayphep/index',
            ],
            'nganhnghe' => [
                'name' => 'Danh mục ngành nghề',
                'url' => 'dmnganhnghe/index',
            ],
           
        ];

        $this->list_danhmuc = array_values($this->list_danhmuc);
        parent::init();
    }


    public function behaviors()
    {
        return  [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],
            ]
        ];
    }
}
