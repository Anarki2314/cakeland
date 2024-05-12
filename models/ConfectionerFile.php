<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confectioner_file".
 *
 * @property int $id
 * @property string $name
 * @property int $confectionerId
 *
 * @property Confectioner $confectioner
 */
class ConfectionerFile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confectioner_file';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'confectionerId'], 'required'],
            [['confectionerId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['confectionerId'], 'exist', 'skipOnError' => true, 'targetClass' => Confectioner::class, 'targetAttribute' => ['confectionerId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'confectionerId' => 'Confectioner ID',
        ];
    }

    /**
     * Gets query for [[Confectioner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfectioner()
    {
        return $this->hasOne(Confectioner::class, ['id' => 'confectionerId']);
    }
}
