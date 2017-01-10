<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.17
 * Time: 20:35
 */

namespace app\web\backend\components;

use app\web\backend\models\Page;
use Yii;
use yii\base\Object;
use yii\web\UrlRuleInterface;

class RoutingUrlRule extends Object implements UrlRuleInterface
{
    const ROUTE = 'routing/render';
    const MAIN_PAGE_URL = 'index';

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if ($pathInfo === '') {
            $pathInfo = self::MAIN_PAGE_URL;
        }

        $parts = explode('/', preg_replace('#/+#', '/', $pathInfo));
        $structure = null;
        $currentPage = null;
        $route = self::ROUTE;

        foreach ($parts as $slug) {
            $page = Page::getBySlug($slug);
            if (!$page) {
                return false;
            }
            $currentPage = $page;
        }

        return [
            $route,
            [
                'page' => $currentPage
            ]
        ];
    }

    public function createUrl($manager, $route, $params)
    {
        if ($route !== self::ROUTE) {
            return false;
        }

        $page = Page::getByID($params['id']);
        $structure = $page->getCurrentStructure();

        $url = [];

        foreach ($structure as $page) {
            $url[] = $page->getSlug();
        }

        return implode('/', $url);
    }
}