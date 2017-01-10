<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.12.16
 * Time: 19:27
 */

namespace app\web\backend\actions\backend;

use yii\base\Action;

class BackendIndexAction extends Action
{
    public function run()
    {
        return $this->controller->render('index');
    }
}