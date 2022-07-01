<?php
/**
 * Created by PhpStorm.
 * User: Duc
 * Date: 7/15/2021
 * Time: 8:41 PM
 */

namespace app\widgets\dmaps;

use app\services\DebugService;
use app\widgets\dmaps\controls\Control;
use app\widgets\dmaps\controls\Scale;
use app\widgets\dmaps\controls\Zoom;
use app\widgets\dmaps\functions\JsFunction;
use app\widgets\dmaps\layers\Layer;
use app\widgets\dmaps\layers\LayerGroup;
use app\widgets\dmaps\layers\Polygon;
use app\widgets\dmaps\layers\TileLayer;
use app\widgets\dmaps\plugins\Plugin;
use app\widgets\dmaps\plugins\PluginManager;
use app\widgets\dmaps\types\LatLng;
use yii\base\Component;
use app\widgets\dmaps\widgets\Map;
use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

class Leaflet extends Component
{

    const JSON_OPTIONS = 352;

    const GLOBAL_VARIABLES = [
        'markers' => 'markers'
    ];

    public $var = 'map';
    public static $counter = 0;

    public static $autoNamePrefix = 'l';

    private $_center;
    public $name = 'map';
    public $zoom = 13;
    public $clientOptions = [];
    public $clientEvents = [];
    private $_layers = [];
    private $_layerGroups = [];

    /**
     * Returns the center of the map.
     * @return LatLng center of the map.
     */
    public function getCenter()
    {
        return $this->_center;
    }

    /**
     * Sets the center of the map.
     *
     * @param LatLng $value center of the map.
     */
    public function setCenter(LatLng $value)
    {
        $this->_center = $value;
    }

    private $_js = [];

    public function setJs($js)
    {
        $this->_js = is_array($js) ? $js : [$js];
        return $this;
    }

    public function appendJs($js)
    {
        $this->_js[] = $js;
        return $this;
    }

    public function getJs()
    {
        $js = [];
        foreach ($this->getLayers() as $layer) {

            if ($layer instanceof Polygon) {
                $layerJs = $layer->encode();
                $insertAtTheBottom = $layer->insertAtTheBottom ? 'true' : 'false';
                $js[] = "$this->name.addLayer($layerJs, $insertAtTheBottom);";
                continue;
            }
            $layer->map = $this->name;
            $js[] = $layer->encode();
        }

        $this->addControl(new Scale());

        $groups = $this->getEncodedLayerGroups($this->getLayerGroups());
        $controls = $this->getEncodedControls($this->getControls());
        $plugins = $this->getEncodedPlugins($this->getPlugins()->getInstalledPlugins());
        $js = ArrayHelper::merge($js, $groups);
        $js = ArrayHelper::merge($js, $controls);
        $js = ArrayHelper::merge($js, $plugins);
        $js = ArrayHelper::merge($js, $this->_js);
//        DebugService::dumpdie($js);
        return $js;
    }

    public static function generateName()
    {
        return self::$autoNamePrefix . self::$counter++;
    }

    public function widget($config = [])
    {
        ob_start();
        ob_implicit_flush(false);
        $config['leaflet'] = $this;
        $widget = new Map($config);
        $out = $widget->run();
        return ob_get_clean() . $out;
    }

    /* Controls */
    private $_controls = [];

    public function setControls(array $controls)
    {
        foreach ($controls as $control) {
            if (!($control instanceof Control)) {
                throw new InvalidParamException("All controls must be of type Control.");
            }
        }
        $this->_controls = $controls;
    }

    public function getControls()
    {
        return $this->_controls;
    }

    public function addControl(Control $control)
    {
        $this->_controls[] = $control;
    }

    public function getEncodedControls($controls)
    {
        return $this->getEncodedObjects($controls);
    }

    /* Functions */
    private $_functions = [];

    public function setFunctions(array $functions)
    {
        foreach ($functions as $function) {
            if (!($function instanceof JsFunction)) {
                throw new InvalidParamException("All controls must be of type Control.");
            }
        }
        $this->_functions = $functions;
    }

    public function getFunctions()
    {
        return $this->_functions;
    }

    public function addFunction(JsFunction $function)
    {
        $this->_functions[] = $function;
    }

    public function getEncodedFunctions($functions)
    {
        return $this->getEncodedObjects($functions);
    }


    private $_tileLayer;

    /**
     * @param TileLayer $tileLayer
     *
     * @return static the component itself
     */
    public function setTileLayer(TileLayer $tileLayer)
    {
        if (!empty($tileLayer->map) && strcmp($tileLayer->map, $this->name) !== 0) {
            $this->name = $tileLayer->map;
        }
        if (empty($tileLayer->map)) {
            $tileLayer->map = $this->name;
        }
        $this->_tileLayer = $tileLayer;

        return $this;
    }

    /**
     * @return TileLayer
     */
    public function getTileLayer()
    {
        return $this->_tileLayer;
    }

    public function addLayer(Layer $layer)
    {
        $this->_layers[] = $layer;
        return $this;
    }

    public function getLayers()
    {
        return $this->_layers;
    }

    public function addLayerGroup(LayerGroup $group)
    {
        $this->_layerGroups[] = $group;
        return $this;
    }

    /**
     * @return layers\LayerGroup[] all stored layer groups
     */
    public function getLayerGroups()
    {
        return $this->_layerGroups;
    }

    /**
     * Clears all stored layer groups
     * @return static the component itself
     */
    public function clearLayerGroups()
    {
        $this->_layerGroups = [];
        return $this;
    }

    /**
     * @var PluginManager
     */
    private $_plugins;

    /**
     * @return PluginManager
     */
    public function getPlugins()
    {
        return $this->_plugins;
    }

    /**
     * Installs a plugin
     *
     * @param Plugin $plugin
     */
    public function installPlugin(Plugin $plugin)
    {
        $plugin->map = $this->name;
        $this->getPlugins()->install($plugin);
    }

    /**
     * Removes an installed plugin
     *
     * @param $plugin
     *
     * @return mixed|null
     */
    public function removePlugin($plugin)
    {
        return $this->getPlugins()->remove($plugin);
    }

    public function init()
    {
        parent::init();
        if (empty($this->center) || empty($this->zoom)) {
            throw new InvalidConfigException("'center' and/or 'zoom' attributes cannot be empty.");
        }
        $this->_plugins = new PluginManager();
        $this->clientOptions['center'] = $this->center->toArray(true);
        $this->clientOptions['zoom'] = $this->zoom;
    }


    /**
     * @param LayerGroup[] $groups
     *
     * @return array
     */
    public function getEncodedLayerGroups($groups)
    {
        return $this->getEncodedObjects($groups);
    }

    /**
     * @param Plugin[] $plugins
     *
     * @return array
     */
    public function getEncodedPlugins($plugins)
    {
        return $this->getEncodedObjects($plugins);
    }

    /**
     * @param $objects
     *
     * @return array
     */
    protected function getEncodedObjects($objects)
    {
        $js = [];
        foreach ((array)$objects as $object) {
            if (property_exists($object, 'map')) {
                $object->map = $this->name;
            }
            $js[] = method_exists($object, 'encode') ? $object->encode() : null;
        }
        return array_filter($js);
    }
}