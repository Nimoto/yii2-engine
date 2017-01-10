<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.16
 * Time: 0:20
 */

namespace app\web\backend\actions\page;

use yii\base\Action;
use app\web\backend\models\Page;

class PageListAction extends Action
{
    public function run()
    {
        $id = 0;
        extract(\Yii::$app->request->get());
        $pages = Page::getList($id, true);
        return $this->controller->render(
            '@backend/views/pages/list',
            [
                'pages' => $pages,
                'id' => $id
            ]
        );
    }
}

