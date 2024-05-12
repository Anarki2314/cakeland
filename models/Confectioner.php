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
    public $fullName;
    public $login;
    public $email;
    public $password;
    public $passwordRepeat;
    public $terms;
    public $documents;
    public $documentsNames = [];
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
            [['inn', 'organizationTypeId', 'password', 'passwordRepeat', 'fullName', 'login', 'email'], 'required'],
            ['terms', 'required', 'requiredValue' => 1, 'message' => 'Вы должны согласиться с условиями пользовательского соглашения'],
            ['email', 'email'],
            [['inn'], 'string', 'min' => 10, 'max' => 12],
            ['inn', 'unique'],
            [['organizationTypeId'], 'integer'],
            [['createdAt'], 'safe'],
            [['organizationTypeId'], 'exist', 'skipOnError' => true, 'targetClass' => OrganizationType::class, 'targetAttribute' => ['organizationTypeId' => 'id']],
            [['statusId'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['statusId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
            [['email', 'login'], 'unique', 'targetClass' => User::class, 'message' => 'Такой логин или email уже существует'],

            [['documents'], 'file', 'skipOnEmpty' => false, 'extensions' => 'doc, docx, pdf', 'maxFiles' => 6],




            [['fullName', 'login', 'email', 'password', 'passwordRepeat'], 'string', 'max' => 255],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],

            ['fullName', 'match', 'pattern' => '/^[а-яА-ЯёЁ]+ [а-яА-ЯёЁ]+ [а-яА-ЯёЁ]+$/u', 'message' => 'Допустимы только русские буквы, формат: "Фамилия Имя Отчество"'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/u', 'message' => 'Допустимы только буквы и цифры'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/u', 'message' => 'Допустимы только буквы и цифры'],
            ['inn', 'match', 'pattern' => '/^(\d{10}|\d{12})$/', 'message' => 'ИНН должен содержать 10 или 12 цифр'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inn' => 'ИНН',
            'userId' => 'Пользователь',
            'organizationTypeId' => 'Тип организации',
            'statusId' => 'Статус',
            'createdAt' => 'Дата регистрации',
            'fullName' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повтор пароля',
            'terms' => 'Согласие на обработку данных',
            'documents' => 'Документы',

        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            foreach ($this->documents as $file) {
                $fileName = $file->baseName . Yii::$app->user->id . '.' . $file->extension;
                $file->saveAs('uploads/' . $fileName);
                $this->documentsNames[] = $fileName;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getDocumentsNames()
    {
        return ConfectionerFile::find()->where(['confectionerId' => $this->id])->select(['name'])->asArray()->all();
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
