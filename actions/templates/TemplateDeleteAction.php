<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.17
 * Time: 14:51
 */

namespace app\web\backend\actions\templates;

use app\web\backend\models\Page;
use yii\base\Action;
use app\web\backend\models\Template;
use yii\helpers\Json;

class TemplateDeleteAction extends Action
{
    public function run()
    {
        $id = false;
        extract(\Yii::$app->request->get());
        $template = Template::getByID($id);
        $pages = Page::getByTemplateID($id);
        if (!$pages && isset($template)) {
            $template->delete();
        }
        return \Yii::$app->getResponse()->redirect('/backend/templates', 301);
    }
}