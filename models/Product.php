<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 * @property int $quantity
 * @property int $categoryId
 * @property int $statusId
 * @property int $userId
 * @property int $imageId
 * @property string $createdAt
 *
 * @property Category $category
 * @property ProductImage $image
 * @property Status $status
 * @property User $user
 */
class Product extends \yii\db\ActiveRecord
{

    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'price', 'quantity', 'categoryId'], 'required'],
            [['description'], 'string'],
            [['price', 'quantity', 'categoryId', 'statusId', 'userId', 'imageId'], 'integer'],
            [['createdAt'], 'safe'],
            [['categoryId'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['categoryId' => 'id']],
            [['statusId'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['statusId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
            [['imageId'], 'exist', 'skipOnError' => true, 'targetClass' => ProductImage::class, 'targetAttribute' => ['imageId' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg'],
            ['title', 'match', 'pattern' => '/^[А-Яа-яЁё\-\s]+$/u', 'message' => 'Допускаются только русские буквы и дефис.'],
            ['description', 'match', 'pattern' => '/^[А-Яа-яЁё\-\s]+$/u', 'message' => 'Допускаются только русские буквы и дефис.'],
            ['description', 'string', 'min' => 100, 'max' => 1000, 'tooShort' => 'Минимальная длина описания 100', 'tooLong' => 'Максимальная длина описания 1000'],

            ['quantity', 'integer', 'min' => 1, 'max' => 99, 'tooSmall' => 'Минимальное количество 1', 'tooBig' => 'Максимальное количество 99'],
            ['price', 'integer', 'min' => 1, 'max' => '20000', 'tooSmall' => 'Минимальная цена 1', 'tooBig' => 'Максимальная цена 20000'],
            ['title', 'string', 'min' => 3, 'max' => 255, 'tooShort' => 'Минимальная длина названия 3', 'tooLong' => 'Максимальная длина названия 255'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'title' => 'Название',
            'description' => 'Описание',
            'price' => 'Цена',
            'quantity' => 'Количество',
            'categoryId' => 'Категория',
            'statusId' => 'Статус',
            'userId' => 'Кондитер',
            'imageId' => 'Изображение',
            'imageFile' => 'Изображение',
            'createdAt' => 'Создан',
        ];
    }


    public function upload()
    {
        if ($this->validate()) {
            $fileName = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs('uploads/' . $fileName);
            $this->imageFile->name = $fileName;
            return true;
        } else {
            return false;
        }
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->userId = Yii::$app->user->id;
            $this->statusId = Status::getStatusByTitle('На модерации')->id;
        }
        return true;
    }
    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'categoryId']);
    }

    /**
     * Gets query for [[Image]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(ProductImage::class, ['id' => 'imageId']);
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
