<?php

/**
 * Description of Module
 *
 * @author admin
 */

namespace app\modules\quanly;

use app\modules\cms\services\AuthService;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use app\widgets\dmaps\layers\LayerGroup;
use app\widgets\dmaps\layers\TileLayer;

class Module extends \yii\base\Module
{
    public $moduleTitle = 'Quản lý danh mục';
    public $moduleName = 'quanly';
    public $list_danhmuc;

    public function init()
    {
        $this->list_danhmuc = [
            // 'hokinhdoanh' => [
            //     'name' => 'Hộ kinh doanh',
            //     'url' => 'hokinhdoanh/index',
            // ],
            
        ];

        $this->list_danhmuc = array_values($this->list_danhmuc);
        $this->params['basemaps'] = [
            0 => new TileLayer([
                'urlTemplate' => 'https://maps.hcmgis.vn/geoserver/wms',
                'service' => TileLayer::WMS,
                'layerName' => 'HCMGIS',
                'clientOptions' => [
                    'layers' => 'hcm_map:hcm_map'
                ],
            ]),
            1 =>
                new TileLayer([
                    'urlTemplate' => 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                    'layerName' => 'OSM',
                    'clientOptions' => [
                        'attribution' => '© OpenStreetMap contributors',
                        'maxZoom' => 22,
                    ],
                ])
            ,

            2 => new TileLayer([
                'urlTemplate' => 'http://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}',
                'layerName' => 'GMAP',
                'clientOptions' => [
                    'attribution' => '© GoogleMap contributors',
                    'maxZoom' => 22,
                    'subdomains' => ['mt0', 'mt1', 'mt2', 'mt3']
                ],
            ])
            ,
        ];
        $this->params['overlays'] = [
            0 => (new LayerGroup())->addLayer(new TileLayer([
                'urlTemplate' => 'http://192.168.1.224:8090/geoserver/hcmbase/wms?',
                'service' => TileLayer::WMS,
                'layerName' => 'Ranh thửa',
                'clientOptions' => [
                    'layers' => 'hcmbase:polygon_ranhthua_phuong11_quan3',
                    'transparent' => true,
                    'format' => 'image/png8',
                    'maxZoom' => 22,
                ],
            ]))
        ];
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
