<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fullName
 * @property string $login
 * @property string $email
 * @property int $roleId
 * @property string $passwordHash
 * @property string $createdAt
 * @property string $authKey
 *
 * @property Confectioner[] $confectioners
 * @property Role $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $password;
    public $passwordRepeat;
    public $terms;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullName', 'login', 'email', 'password', 'passwordRepeat'], 'required'],
            [['roleId'], 'integer'],
            ['terms', 'required', 'requiredValue' => 1, 'message' => 'Вы должны согласиться с условиями пользовательского соглашения'],
            [['createdAt'], 'safe'],
            [['fullName', 'login', 'email', 'password', 'passwordRepeat'], 'string', 'max' => 255],
            ['email', 'email'],
            [['login'], 'unique'],
            [['email'], 'unique'],
            [['roleId'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['roleId' => 'id']],
            ['fullName', 'match', 'pattern' => '/^[а-яА-ЯёЁ]+ [а-яА-ЯёЁ]+ [а-яА-ЯёЁ]+$/u', 'message' => 'Допустимы только русские буквы, формат: "Фамилия Имя Отчество"'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/u', 'message' => 'Допустимы только буквы и цифры'],
            ['passwordRepeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => '/^[a-zA-Z0-9]+$/u', 'message' => 'Допустимы только буквы и цифры'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullName' => 'ФИО',
            'login' => 'Логин',
            'email' => 'Email',
            'roleId' => 'Роль',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повтор пароля',
            'createdAt' => 'Дата регистрации',
            'terms' => 'Согласие на обработку данных',
        ];
    }



    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    public static function findByLogin($login)
    {
        return static::findOne(['login' => $login]);
    }

    public function getIsAdmin()
    {
        return $this->roleId == Role::getRoleByTitle('admin')->id;
    }

    public function getIsConfectioner()
    {
        return $this->roleId == Role::getRoleByTitle('confectioner')->id;
    }

    public function getIsUser()
    {
        return $this->roleId == Role::getRoleByTitle('user')->id;
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->passwordHash = Yii::$app->security->generatePasswordHash($this->password);
            $this->authKey = Yii::$app->security->generateRandomString();
        }

        // ...custom code here...
        return true;
    }

    /**
     * Gets query for [[Confectioners]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfectioners()
    {
        return $this->hasMany(Confectioner::class, ['userId' => 'id']);
    }



    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'roleId']);
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
