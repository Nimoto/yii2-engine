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

class BlocksListAction extends Action
{
    public function run()
    {
        $blocks = Block::getList();
        return $this->controller->render(
            '@backend/views/blocks/list',
            [
                'blocks' => $blocks
            ]
        );
    }
}