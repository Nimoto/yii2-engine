<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.12.16
 * Time: 19:11
 */

namespace app\web\backend\controllers;

use yii\base\Controller;
use yii\filters\AccessControl;
use budyaga\users\models\User;

class BackendController extends Controller
{
    public $layout = '@backend/views/layouts/main';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
                    [
                        'actions' => ['pages', 'pages-edit', 'pages-add', 'pages-delete', 'blocks', 'blocks-edit', 'blocks-add', 'blocks-delete', 'templates', 'templates-edit', 'templates-add', 'templates-delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'index' => [
                'class' => 'app\web\backend\actions\BackendIndexAction'
            ],
            'pages' => [
                'class' => 'app\web\backend\actions\page\PageListAction',
            ],
            'pages-edit' => [
                'class' => 'app\web\backend\actions\page\PageEditAction',
            ],
            'pages-add' => [
                'class' => 'app\web\backend\actions\page\PageAddAction',
            ],
            'pages-delete' => [
                'class' => 'app\web\backend\actions\page\PageDeleteAction',
            ],
            'blocks' => [
                'class' => 'app\web\backend\actions\blocks\BlocksListAction',
            ],
            'blocks-add' => [
                'class' => 'app\web\backend\actions\blocks\BlocksAddAction',
            ],
            'blocks-edit' => [
                'class' => 'app\web\backend\actions\blocks\BlocksEditAction',
            ],
            'blocks-delete' => [
                'class' => 'app\web\backend\actions\blocks\BlocksDeleteAction',
            ],
            'templates' => [
                'class' => 'app\web\backend\actions\templates\TemplateListAction',
            ],
            'templates-add' => [
                'class' => 'app\web\backend\actions\templates\TemplateAddAction',
            ],
            'templates-edit' => [
                'class' => 'app\web\backend\actions\templates\TemplateEditAction',
            ],
            'templates-delete' => [
                'class' => 'app\web\backend\actions\templates\TemplateDeleteAction',
            ]
        ];
    }
}