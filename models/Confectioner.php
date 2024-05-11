<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "confectioner".
 *
 * @property int $id
 * @property int $inn
 * @property int $userId
 * @property int $organizationTypeId
 * @property int $statusId
 * @property string $createdAt
 *
 * @property OrganizationType $organizationType
 * @property Status $status
 * @property User $user
 */
class Confectioner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'confectioner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inn', 'userId', 'organizationTypeId', 'statusId'], 'required'],
            [['inn', 'userId', 'organizationTypeId', 'statusId'], 'integer'],
            [['createdAt'], 'safe'],
            [['organizationTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationType::class, 'targetAttribute' => ['organizationTypeId' => 'id']],
            [['statusId'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['statusId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'Inn',
            'userId' => 'User ID',
            'organizationTypeId' => 'Organization Type ID',
            'statusId' => 'Status ID',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[OrganizationType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizationType()
    {
        return $this->hasOne(OrganizationType::class, ['id' => 'organizationTypeId']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'statusId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
