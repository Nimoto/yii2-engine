<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.16
 * Time: 0:20
 */

namespace app\web\backend\actions\templates;

use yii\base\Action;
use app\web\backend\models\Template;
use app\web\backend\models\Block;
use app\web\backend\models\TemplateBlocks;
use yii\helpers\Json;

class TemplateAddAction extends Action
{
    public function run()
    {
        $template = new Template();
        $blocks = Block::getList();
        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $template->load($post);
            $template->save();
            if (isset($post['Block']['params'])) {
                $paramsRaw = $post['Block']['params'];
                foreach ($paramsRaw as $block) {
                    $templateBlocks = new TemplateBlocks();
                    $templateBlocks->setSort($block['sort']);
                    $templateBlocks->setTemplateId($template->id);
                    $templateBlocks->setBlockId($block['id']);
                    if (isset($block['params'])) {
                        $params = [];
                        foreach ($block['params'] as $param => $value) {
                            if (!empty($value)) {
                                $params[$param] = $value;
                            }
                        }
                        $templateBlocks->setParams($params);
                    }
                    $templateBlocks->save();
                }
            }
            return \Yii::$app->getResponse()->redirect('/backend/templates', 301);
        }
        return $this->controller->render(
            '@backend/views/templates/form',
            [
                'template' => $template,
                'blocks' => $blocks,
                'templateBlocks' => []
            ]
        );
    }
}