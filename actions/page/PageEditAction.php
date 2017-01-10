<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19.12.16
 * Time: 0:20
 */

namespace app\web\backend\actions\page;

use yii\base\Action;
use app\web\backend\models\Template;
use app\web\backend\models\Page;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class PageEditAction extends Action
{
    public function run($id = false)
    {
        extract(\Yii::$app->request->get());

        if (!$id) {
            throw new NotFoundHttpException();
        }

        $page = Page::getByID($id);
        if (\Yii::$app->request->post()) {
            $post = \Yii::$app->request->post();
            $page->load($post);
            $page->setSort($post['Page']['sort']);
            if (isset($post['Page']['params'])) {
                $paramsRow = $post['Page']['params'];
                $params = [];
                foreach ($paramsRow as $param) {
                    if (!empty($param['key'])) {
                        $params[$param['key']] = $param['value'];
                    }
                }
                $page->setParams($params);
            }

            $image = UploadedFile::getInstance($page, 'image');
            if (isset($image)) {
                $uploadFilePath = $_SERVER['DOCUMENT_ROOT'].'/images/page/'.$id.'/image/';
                if (!file_exists($uploadFilePath)) {
                    mkdir($uploadFilePath, 0777, true);
                }
                if (move_uploaded_file($image->tempName, $uploadFilePath . $image->name)) {
                    $page->setImage($uploadFilePath . $image->name);
                }
            } else if (isset($post['Page']['curr_image'])) {
                $page->setImage($post['Page']['curr_image']);
            } else {
                $page->setImage('');
            }

            $smallImage = UploadedFile::getInstance($page, 'small_image');
            if (isset($smallImage)) {
                $uploadFilePath = $_SERVER['DOCUMENT_ROOT'].'/images/page/'.$id.'/small_image/';
                if (!file_exists($uploadFilePath)) {
                    mkdir($uploadFilePath, 0777, true);
                }
                if (move_uploaded_file($smallImage->tempName, $uploadFilePath . $smallImage->name)) {
                    $page->setSmallImage($uploadFilePath . $smallImage->name);
                }
            } else if (isset($post['Page']['curr_small_image'])) {
                $page->setSmallImage($post['Page']['curr_small_image']);
            } else {
                $page->setSmallImage('');
            }

            $page->update();
        }

        $pages = [
            0 => 'Корневой раздел'
        ];
        $pagesModels = Page::getList();
        foreach ($pagesModels as $pagesModel) {
            $pages[$pagesModel->id] = $pagesModel->name;
        }

        $templates = [];
        $templatesModels = Template::getList();
        foreach ($templatesModels as $templatesModel) {
            $templates[$templatesModel->id] = $templatesModel->name;
        }

        return $this->controller->render(
            '@backend/views/pages/form',
            [
                'page' => $page,
                'pages' => $pages,
                'templates' => $templates
            ]
        );
    }
}