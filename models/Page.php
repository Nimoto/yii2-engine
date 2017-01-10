<?php

namespace app\web\backend\models;

use Yii;
use yii\helpers\Json;
use yii\helpers\Url;

/**
 * This is the model class for table "Page".
 *
 * @property integer $id
 * @property string $name
 * @property string $h1
 * @property string $title
 * @property string $description
 * @property string $announce
 * @property string $text
 * @property integer $active
 * @property integer $parent_id
 * @property integer $sort
 * @property string $slug
 */
class Page extends \yii\db\ActiveRecord
{
    const DEFAULT_SORT = 100;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'name'], 'required'],
            [['active', 'parent_id', 'sort', 'template_id'], 'integer'],
            [['h1', 'title', 'description', 'announce', 'text', 'image', 'small_image', 'params'], 'string'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'h1' => 'H1',
            'title' => 'Title',
            'description' => 'Description',
            'announce' => 'Announce',
            'text' => 'Text',
            'active' => 'Active',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
            'slug' => 'Slug',
            'template_id' => 'Template ID',
            'image' => 'Image',
            'small_image' => 'Small Image',
            'params' => 'Params'
        ];
    }

    public static function getList($id = false, $showUnactive = false)
    {
        $pages = Page::find();

        $where = [];

        if (!$showUnactive) {
            $where['active'] = '1';
        }

        if ($id !== false) {
            $where['parent_id'] = $id;
        }

        if (!empty($where)) {
            $pages->where(
                $where
            );
        }

        return $pages->all();
    }

    public static function getByID($id)
    {
        return self::find()
            ->where(
                [
                    'id' => $id
                ]
            )
            ->one();
    }

    public static function getBySlug($slug)
    {
        return self::find()
            ->where(
                [
                    'slug' => $slug
                ]
            )
            ->one();
    }

    public function getParams()
    {
        if ($this->params !== null) {
            return Json::decode($this->params);
        } else {
            return [];
        }
    }

    public function setParentID($value = null)
    {
        $this->parent_id = $value;
    }

    public function setSort($value = null)
    {
        $this->sort = $value != false ? $value : self::DEFAULT_SORT;
    }

    public function getAnnounce()
    {
        return $this->announce;
    }

    public function getH1()
    {
        return $this->h1;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getParentId()
    {
        return $this->parent_id;
    }

    public function setParams($params = [])
    {
        $this->params = Json::encode($params);
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getPathImage()
    {
        return str_replace(Yii::getAlias('@webroot'), '', $this->image);
    }

    public function getSmallImage()
    {
        return $this->small_image;
    }

    public function getPathSmallImage()
    {
        return str_replace(Yii::getAlias('@webroot'), '', $this->small_image);
    }

    static function getStructure($page, $structure)
    {
        $structure[] = $page;

        if ($parentId = $page->getParentId()) {
            $page = self::getByID($parentId);
            $structure = self::getStructure($page, $structure);
        }

        return $structure;

    }

    public function getCurrentStructure()
    {
        $structure = [];
        $structure = self::getStructure($this, $structure);
        return array_reverse($structure);
    }

    public function getBreadcrumbs()
    {
        $structure = $this->getCurrentStructure();
        $breadcrumbs = [];
        $breadcrumbs[] = [
            'link' => '/',
            'label' => 'Главная'
        ];

        foreach ($structure as $key => $page) {
            $breadcrumbs[] = [
                'link' => Url::to(['routing/render', 'id' => $page->id]),
                'label' => $page->getName()
            ];
        }

        unset($breadcrumbs[count($breadcrumbs) - 1]['link']);

        return $breadcrumbs;
    }

    public function getByTemplateID($templateId)
    {
        return self::find()
            ->where(
                [
                    'template_id' => $templateId
                ]
            )
            ->all();
    }

    public function setImage($image = '')
    {
        $this->image = $image;
    }

    public function setSmallImage($image = '')
    {
        $this->small_image = $image;
    }
 }
