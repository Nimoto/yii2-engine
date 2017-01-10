<?php

namespace app\web\backend\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "TemplateBlocks".
 *
 * @property integer $id
 * @property integer $template_id
 * @property integer $block_id
 * @property integer $sort
 * @property string $params
 */
class TemplateBlocks extends \yii\db\ActiveRecord
{
    const DEFAULT_SORT = 100;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TemplateBlocks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['template_id', 'block_id'], 'required'],
            [['template_id', 'block_id', 'sort'], 'integer'],
            [['params'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'template_id' => 'Template ID',
            'block_id' => 'Block ID',
            'sort' => 'Sort',
            'params' => 'Params',
        ];
    }

    public static function deleteForTemplate($id)
    {
        $templateBlocks = TemplateBlocks::getForTemplate($id);
        foreach ($templateBlocks as $record) {
            $record->delete();
        }
    }

    public static function getForTemplate($id)
    {
        return TemplateBlocks::find()
            ->where(
                [
                    'template_id' => $id
                ]
            )
            ->all();
    }

    public function setSort($value = null)
    {
        $this->sort = $value != false ? $value : self::DEFAULT_SORT;
    }

    public function getSort()
    {
        return $this->sort;
    }

    public function setTemplateId($value = null)
    {
        $this->template_id = $value;
    }

    public function setBlockId($value = null)
    {
        $this->block_id = $value;
    }

    public function getParams()
    {
        if ($this->params !== null) {
            return Json::decode($this->params);
        } else {
            return [];
        }
    }

    public function setParams($params = [])
    {
        $this->params = Json::encode($params);
    }
}
