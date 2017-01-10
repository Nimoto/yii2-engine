<?php

namespace app\web\backend\models;

use Yii;
use yii\helpers\Json;

/**
 * This is the model class for table "Block".
 *
 * @property integer $id
 * @property string $name
 * @property string $key
 * @property string $view
 * @property string $params
 */
class Block extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'view'], 'required'],
            [['view', 'params'], 'string'],
            [['name', 'key'], 'string', 'max' => 255],
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
            'key' => 'Key',
            'view' => 'View',
            'params' => 'Params',
        ];
    }

    public static function getList()
    {
        return self::find()->all();
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

    public static function getByIDs($ids)
    {
        return self::find()
            ->where(
                [
                    'id' => $ids
                ]
            )
            ->all();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getView()
    {
        return $this->view;
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
