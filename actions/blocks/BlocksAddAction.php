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

class BlocksAddAction extends Action
{
    public function run()
    {
        $block = new Block();
        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $block->load($post);
            if (isset($post['Block']['params'])) {
                $paramsRow = $post['Block']['params'];
                $params = [];
                foreach ($paramsRow as $param) {
                    if (!empty($param['key'])) {
                        $params[$param['key']] = $param['value'];
                    }
                }
                $block->setParams($params);
            }
            $block->save();
            return \Yii::$app->getResponse()->redirect('/backend/blocks', 301);
        }
        return $this->controller->render(
            '@backend/views/blocks/form',
            [
                'block' => $block
            ]
        );
    }
}