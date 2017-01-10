<?php
use dektrium\user\Module;

return [
	'controllerMap' => [
        'backend' => [
            'class' => 'app\web\backend\controllers\BackendController'
        ],
        'routing' => [
            'class' => 'app\web\backend\controllers\RoutingController'
        ],
	],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'backend/login' => 'user/security/login',
                'backend/logout' => 'user/security/logout',
                'backend/registration' => '/user/registration/register',
                'backend/<action:>' => 'backend/<action>',
                '<page:[\w_\/-]+>' => [
                    'class' => \app\web\backend\components\RoutingUrlRule::class
                ]
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'request' => [
            'enableCsrfValidation' => false,
        ],
    ],
    'modules' => [
        'user' => [
            'class' => Module::class,
        ],
    ],
    'aliases' => [
        '@backend' => $_SERVER['DOCUMENT_ROOT'] . '/backend'
    ],
];
?>