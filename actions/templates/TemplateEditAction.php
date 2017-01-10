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
use yii\helpers\Json;
use app\web\backend\models\TemplateBlocks;

class TemplateEditAction extends Action
{
    public function run($id = false)
    {
        extract(\Yii::$app->request->get());
        if (!$id) {
            throw new NotFoundHttpException();
        }
        $template = Template::getByID($id);
        $blocks = Block::getList();
        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $template->load($post);
            $template->update();
            if (isset($post['Block']['params'])) {
                TemplateBlocks::deleteForTemplate($template->id);
                $paramsRaw = $post['Block']['params'];
                foreach ($paramsRaw as $block) {
                    if ($block['id'] == 0) {
                        continue;
                    }
                    $templateBlock = new TemplateBlocks();
                    $templateBlock->setSort($block['sort']);
                    $templateBlock->setTemplateId($template->id);
                    $templateBlock->setBlockId($block['id']);
                    if (isset($block['params'])) {
                        $params = [];
                        foreach ($block['params'] as $param => $value) {
                            if (!empty($value)) {
                                $params[$param] = $value;
                            }
                        }
                        $templateBlock->setParams($params);
                    }
                    $templateBlock->save();
                }
            }
        }

        $templateBlocks = [];
        $templateBlocksModel = TemplateBlocks::getForTemplate($template->id);
        foreach ($templateBlocksModel as $model) {
            $templateBlocks[$model->block_id] = [
                'sort' => $model->sort,
                'params' => Json::decode($model->params)
            ];
        }
        return $this->controller->render(
            '@backend/views/templates/form',
            [
                'template' => $template,
                'blocks' => $blocks,
                'templateBlocks' => $templateBlocks
            ]
        );
    }
}