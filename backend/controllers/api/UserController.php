<?php
/**
 * /var/www/html/homework/backend/runtime/giiant/f197ab8e55d1e29a2dea883e84983544
 *
 * @package default
 */


namespace backend\controllers\api;

/**
 * This is the class for REST controller "UserController".
 */
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class UserController extends \yii\rest\ActiveController
{
	public $modelClass = 'app\models\User';
}
