<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 7/15/2021
 * Time: 8:42 PM
 */
namespace app\widgets\dmaps\widgets;

use app\services\DebugService;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use app\widgets\dmaps\Leaflet;
use app\widgets\dmaps\LeafletAsset;

class Map extends Widget
{
    public $leaflet;

    public $height = '300';

    public $options = [];

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (empty($this->leaflet) || !($this->leaflet instanceof Leaflet)) {
            throw new InvalidConfigException(
                "'leafLet' attribute cannot be empty and should be of type LeafLet component."
            );
        }
        if (is_numeric($this->height)) {
            $this->height .= 'px';
        }

        Html::addCssStyle($this->options, ['height' => $this->height], false);
    }

    /**
     * Renders the map
     * @return string|void
     */
    public function run()
    {
        echo "\n" . Html::tag('div', '', $this->options);
        $this->registerScript();
    }

    /**
     * Register the script for the map to be rendered according to the configurations on the LeafLet
     * component.
     */
    public function registerScript()
    {
        $view = $this->getView();
        LeafLetAsset::register($view);
        $this->leaflet->getPlugins()->registerAssetBundles($view);

        $view->registerJs("var ".implode(',' , Leaflet::GLOBAL_VARIABLES).";");

        $id = $this->options['id'];
        $name = $this->leaflet->name;
        $js = $this->leaflet->getJs();


        $clientOptions = $this->leaflet->clientOptions;

        // for map load event to fire, we have to postpone setting view, until events are bound
        // see https://github.com/Leaflet/Leaflet/issues/3560
        $lateInitClientOptions['center'] = Json::encode($clientOptions['center']);
        $lateInitClientOptions['zoom'] = $clientOptions['zoom'];
        if (isset($clientOptions['bounds'])) {
            $lateInitClientOptions['bounds'] = $clientOptions['bounds'];
            unset($clientOptions['bounds']);
        }
        unset($clientOptions['center']);
        unset($clientOptions['zoom']);

        $options = empty($clientOptions) ? '{}' : Json::encode($clientOptions, Leaflet::JSON_OPTIONS);
        array_unshift($js, $this->leaflet->var . " = new L.map('$id', $options);");
        if ($this->leaflet->getTileLayer() !== null) {
            $js[] = $this->leaflet->getTileLayer()->encode();
        }

        $clientEvents = $this->leaflet->clientEvents;

        if (!empty($clientEvents)) {
            foreach ($clientEvents as $event => $handler) {
                $js[] = "$name.on('$event', $handler);";
            }
        }

        if (isset($lateInitClientOptions['bounds'])) {
            $js[] = "$name.fitBounds({$lateInitClientOptions['bounds']});";
        } else {
            $js[] = "$name.setView({$lateInitClientOptions['center']}, {$lateInitClientOptions['zoom']});";
        }

        $view->registerJs("function {$name}_init(){\n" . implode("\n", $js) . "}\n{$name}_init();");
        $functions = $this->leaflet->getFunctions();
        $initFunctionsJS = "";
        if(sizeof($functions) > 0){
            foreach ($functions as $index => $function) {
//                DebugService::dumpdie($function);
                $function->map = $name;
                $view->registerJs($function->encode());
                $param = '';
//                if (in_array("url", $function->params)) {
//                    $param = $function->listUrl;
//                }
                $initFunctionsJS .= "init{$function->name}();";
            }
            $view->registerJs($initFunctionsJS);
        }
    }
}