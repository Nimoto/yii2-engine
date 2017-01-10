<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 02.01.17
 * Time: 15:03
 */

namespace app\web\backend\controllers;

use app\web\backend\models\Block;
use app\web\backend\models\Page;
use app\web\backend\models\TemplateBlocks;
use yii\base\Controller;
use yii\helpers\ArrayHelper;

class RoutingController extends Controller
{

    public function actionRender()
    {
        $page = \Yii::$app->request->get('page');
        $pageParams = $page->getParams();


        $blocksTemplates = TemplateBlocks::getForTemplate($page->template_id);

        $blockParams = [];
        foreach ($blocksTemplates as $blockTemplate) {
            $blockParams[$blockTemplate->block_id]['params'] = $blockTemplate->getParams();
            $blockParams[$blockTemplate->block_id]['sort'] = $blockTemplate->getSort() * 100;
        }

        $blocks = Block::getByIDs(array_keys($blockParams));
        $views = [];
        foreach ($blocks as $block) {
            $params = $block->getParams();
            $params['page'] = $page;
            if (isset($pageParams)) {
                $params = ArrayHelper::merge(
                    $params,
                    $pageParams
                );
            }
            if (isset($blockParams[$block->id]['params'])) {
                $params = ArrayHelper::merge(
                    $params,
                    $blockParams[$block->id]['params'],
                    $pageParams
                );
            }
            $sort = $blockParams[$block->id]['sort'];
            while (isset($views[$sort])) {
                $sort++;
            }
            $views[$sort] = [
                'alias' => $block->view,
                'params' => $params
            ];
        }
        ksort($views);

        return $this->render(
            '@app/web/backend/views/routing/render',
            [
                'views' => $views,
                'page' => $page
            ]
        );
    }
}