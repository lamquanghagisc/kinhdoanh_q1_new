<?php

namespace app\modules\auth\services;

use app\modules\Constant;
use app\modules\auth\models\AuthAction;
use app\modules\contrib\helper\DateHelper;
use Yii;
use yii\helpers\ArrayHelper;

class AuthActionService
{
    #region Public

    /**
     * Generate actions
     *
     * @return array
     */
    public static function generateActions()
    {
        $modules = Yii::$app->getModule('auth')->actionModules;
        $temp = [];
        $actionNames = [];
        foreach ($modules as $module) {
            $temp[$module] = self::getRouteRecursive(Yii::$app->getModule($module));
        }

        foreach ($temp as $module => $controllers) {
            foreach ($controllers as $controller => $actions) {
                foreach ($actions as $action) {
                    $actionNames[] = $module . '.' . $controller . '.' . $action;
                }
            }
        }
        AuthAction::updateAll(['status' => Constant::STATUS_DELETED], ['not in', 'name', $actionNames]);
        $oldActionNames = ArrayHelper::getColumn(AuthAction::find()->asArray()->all(), 'name');
        $result = true;
        foreach ($actionNames as $actionName) {
            if (!in_array($actionName, $oldActionNames)) {
                $authAction = new AuthAction();
                $authAction->name = $actionName;
                $authAction->status = Constant::STATUS_ACTIVE;
                $authAction->created_at = DateHelper::now();
                $result = $result && $authAction->save();
            }
        }

        return $result;
    }

    /**
     * Get all actions
     *
     * @return AuthAction[]
     */
    public static function getAll()
    {
        return AuthAction::find()->asArray()->all();
    }

    #endregion



    #region Route

    protected static function getRouteRecursive($module)
    {
        $result = [];
        $namespace = trim($module->controllerNamespace, '\\') . '\\';
        self::getControllerFiles($module, $namespace, '', $result);
        return $result;
    }

    protected static function getControllerFiles($module, $namespace, $prefix, &$result)
    {
        $path = Yii::getAlias('@' . str_replace('\\', '/', $namespace), false);
        if (!is_dir($path)) {
            return;
        }
        foreach (scandir($path) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            if (is_dir($path . '/' . $file) && preg_match('%^[a-z0-9_/]+$%i', $file . '/')) {
                self::getControllerFiles(
                    $module,
                    $namespace . $file . '\\',
                    $prefix . $file . '/',
                    $result
                );
            } elseif (strcmp(substr($file, -14), 'Controller.php') === 0) {
                $baseName = substr(
                    basename($file),
                    0,
                    -14
                );
                $name = strtolower(preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $baseName));
                $id = ltrim(str_replace(' ', '-', $name), '-');
                $className = $namespace . $baseName . 'Controller';
                if (strpos($className, '-') === false && class_exists($className) && is_subclass_of($className, 'yii\base\Controller')) {
                    $controller = Yii::createObject($className, [$prefix . $id, $module]);
                    self::getActionRoutes($controller, $result);
                }
            }
        }
    }

    protected static function getActionRoutes($controller, &$result)
    {
        foreach ($controller->actions() as $id => $value) {
            $result[$controller->id][] =  $id;
        }
        $class = new \ReflectionClass($controller);
        foreach ($class->getMethods() as $method) {
            $name = $method->getName();
            if ($method->isPublic() && !$method->isStatic() && strpos($name, 'action') === 0 && $name !== 'actions') {
                $name = strtolower(preg_replace('/(?<![A-Z])[A-Z]/', ' \0', substr($name, 6)));
                $id =  ltrim(str_replace(' ', '-', $name), '-');
                $result[$controller->id][] = $id;
            }
        }
    }

    #endregion
}
