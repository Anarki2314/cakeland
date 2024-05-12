<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property Confectioner[] $confectioners
 */
class OrganizationType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization_type';
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
        return $this->hasMany(Confectioner::class, ['organizationTypeId' => 'id']);
    }

    public static function getTypes()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getTypeById($id)
    {
        return static::find()->where(['id' => $id])->one();
    }

    public static function getTypeByTitle($title)
    {
        return static::find()->where(['title' => $title])->one();
    }
}
