<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.16
 * Time: 0:20
 */

namespace app\web\backend\actions\blocks;

use yii\base\Action;
use app\web\backend\models\Block;
use yii\helpers\Json;

class BlocksEditAction extends Action
{
    public function run()
    {
        $id = false;
        extract(\Yii::$app->request->get());
        $block = Block::getByID($id);
        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $block->load($post);
            if (isset($post['Block']['params'])) {
                $paramsRow = $post['Block']['params'];
                $params = [];
                foreach ($paramsRow as $param) {
                    $params[$param['key']] = $param['value'];
                }
                $block->setParams($params);
            }
            $block->update();
        }
        return $this->controller->render(
            '@backend/views/blocks/form',
            [
                'block' => $block
            ]
        );
    }
}