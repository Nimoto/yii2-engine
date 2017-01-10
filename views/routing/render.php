<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.01.17
 * Time: 15:34
 */
$this->title = $page->title;
$this->registerMetaTag([
    'description' => $page->description
]);
foreach ($views as $view) {
    echo $this->render(
        $view['alias'],
        $view['params']
    );
}