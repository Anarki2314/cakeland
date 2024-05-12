<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_order".
 *
 * @property int $id
 * @property int $userId
 * @property int $statusId
 * @property string $createdAt
 *
 * @property OrderProduct[] $orderProducts
 */
class UserOrder extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'statusId'], 'required'],
            [['userId', 'statusId'], 'integer'],
            [['createdAt'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'statusId' => 'Status ID',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['orderId' => 'id']);
    }
}
