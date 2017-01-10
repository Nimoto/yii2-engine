<?php

namespace app\web\backend\actions\templates;

use yii\base\Action;
use app\web\backend\models\Template;

class TemplateListAction extends Action
{
    public function run()
    {
        $templates = Template::getList();
        return $this->controller->render(
            '@backend/views/templates/list',
            [
                'templates' => $templates
            ]
        );
    }
}