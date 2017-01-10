<?php

namespace app\web\backend\models;

use Yii;

/**
 * This is the model class for table "Template".
 *
 * @property integer $id
 * @property string $name
 */
class Template extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['key'], 'string', 'max' => 50],
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

    public function getName()
    {
        return $this->name;
    }

    public function getKey()
    {
        return $this->key;
    }
}
