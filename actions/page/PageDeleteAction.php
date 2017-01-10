<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.17
 * Time: 14:50
 */

namespace app\web\backend\actions\page;

use yii\base\Action;
use app\web\backend\models\Page;
use yii\helpers\Json;

class PageDeleteAction extends Action
{
    public function run()
    {
        $id = false;
        extract(\Yii::$app->request->get());
        $page = Page::getByID($id);
        $pages = Page::getList($id);
        foreach ($pages as $page) {
            $page->setParentID(null);
            $page->update();
        }
        if (isset($page)) {
            $page->delete();
        }
        return \Yii::$app->getResponse()->redirect('/backend/pages', 301);
    }
}