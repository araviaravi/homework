<?php

namespace app\modules;

use dmstr\web\traits\AccessBehaviorTrait;

class User extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
