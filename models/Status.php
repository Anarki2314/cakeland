<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $title
 *
 * @property Confectioner[] $confectioners
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Confectioners]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfectioners()
    {
        return $this->hasMany(Confectioner::class, ['statusId' => 'id']);
    }

    public static function getStatuses()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getStatusById($id)
    {
        return static::findOne($id);
    }

    public static function getStatusByTitle($title)
    {
        return static::find()->where(['title' => $title])->one();
    }
}
