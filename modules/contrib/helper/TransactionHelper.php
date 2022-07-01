<?php



namespace app\modules\contrib\helper;

class TransactionHelper
{
    public static function run($func, ...$args)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $result = call_user_func($func, $args);
            if ($result) {
                $transaction->commit();
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            $transaction->rollBack();
            if (YII_ENV_DEV) {
                throw $th;
            }
            return false;
        }
    }
}
