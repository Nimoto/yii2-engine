<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.17
 * Time: 14:50
 */

namespace app\web\backend\actions\blocks;

use yii\base\Action;
use app\web\backend\models\Block;
use yii\helpers\Json;

class BlocksDeleteAction extends Action
{
    public function run()
    {
        $id = false;
        extract(\Yii::$app->request->get());
        $block = Block::getByID($id);
        if (isset($block)) {
            $block->delete();
        }
        return \Yii::$app->getResponse()->redirect('/backend/blocks', 301);
    }
}