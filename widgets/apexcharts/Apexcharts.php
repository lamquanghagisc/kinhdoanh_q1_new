<?php
/**
 * Created by PhpStorm.
 * User: MinhDuc
 * Date: 6/24/2020
 * Time: 1:11 AM
 */

namespace app\widgets\apexcharts;

use app\services\DebugService;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class Apexcharts extends Widget
{

    const TYPE_PIE = 'pie';
    const TYPE_BAR = 'bar';
    const TYPE_LINE = 'line';
    const TYPE_DONUT = 'donut';

    public $id = 'apexcharts-widget';
    public $timeout = 500;
    public $chartOptions = [];
    public $series = [];
    public $type = 'line';
    public $width = '100%';
    public $height = 350;

    public $title = false;
    public $options = [];
    public $data = [];
    public $label = [];
    public $labelColor = '#fff';
    public $labelDropShadow = [];
    public $stacked = false;
    public $fill = [];
    /*label options*/
    public $labelOptions = [];

    public $strokeOptions = [];

    public $legendOptions = [];
    public $plotOptions = [];

    public $js = [];

    private $colors = [
        '#2c9f45','#0099e5','#cf8d2e',  '#6639b7', '#caccd1','#00a78e', '#009f4d','#da1884', '#00a4e4','#00a78e','#ffdd00', '#ff0000','#c1d82f', '#fbb034', '#7d3f98','#4d4f53'
    ];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $this->options['id'] = $this->id;
        echo "\n" . Html::tag('div', '', $this->options);
        $this->registerScript();
    }

    public function registerScript()
    {
        $view = $this->getView();
//        $data = json_encode($this->data,JSON_UNESCAPED_UNICODE);
//        $label = json_encode($this->label,JSON_UNESCAPED_UNICODE);
//        DebugService::dumpdie($this->chartOptions);


        $options = [
            'series' => $this->data,
            'colors' => $this->colors,
            'chart' => $this->initChartOptions(),


        ];

        if ($this->strokeOptions != null) {
            $options['stroke'] = $this->strokeOptions;
        }

        if ($this->type == 'bar') {
            $options['xaxis'] = [
                'categories' => $this->label,
            ];
            $options['dataLabels'] = [
                'enabled' => true,

                'style' => [
                    'fontSize' => '10px',
                    'colors' => [$this->labelColor]
                ]
            ];

            $options['legend'] = $this->legendOptions;

        }


        if ($this->type == 'pie' || $this->type == 'donut') {
            $options['labels'] = $this->label;
            $options['responsive'] = [[
                'breakpoint' => 480,
                'options' => [
                    'chart' => [
                        'width' => '100%',
                        'height' => '200px'
                    ],
                    'legend' => $this->legendOptions,
                ]
            ]];
//            $options = json_encode($options, JSON_UNESCAPED_UNICODE);
////
//            DebugService::dumpdie($options);
        }



        if($this->fill != null){
            $options['fill'] = $this->fill;
        }

        if($this->labelDropShadow != null){
            $options['dataLabels']['dropShadow'] = $this->labelDropShadow;
        }

        if($this->plotOptions != null){
            $options['plotOptions'] = $this->plotOptions;
        }

        $options = json_encode($options, JSON_UNESCAPED_UNICODE);
        $js[] = "var options$this->id = $options;";
        $js[] = "var $this->id = new ApexCharts(document.querySelector('#$this->id'), options$this->id);";
        $js[] = "$this->id.render();";
        $view->registerJs(implode("\n", $js));
    }

    private function initChartOptions()
    {
        $chartOptions = $this->chartOptions;
        $chartOptions['type'] = $this->type;
        $chartOptions['height'] = $this->height;
        $chartOptions['width'] = $this->width;
        $chartOptions['stacked'] = $this->stacked;
        $chartOptions['title'] = $this->title;
        return $chartOptions;
    }


    private function initLabelOptions()
    {
        $labelOptions = [];
        $labelOptions = $this->labelOptions;
//        DebugService::dumpdie($this->chartOptions);
        return $labelOptions;
    }

    private function pieOptions()
    {
        $pieOptions['responsive'] = [
            'breakpoint' => 480,
        ];
        return $pieOptions;

    }
}