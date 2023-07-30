<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\AuthAssignment;
use yii\base\Model;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $auth_key
 *
 * @property Practice[] $practices
 * @property StudentGroup[] $studentGroups
 * @property StudentResume[] $studentResumes
 */
class Employer extends Model
{
    public $name;
    public $surname;
    public $patronymic;

    public $email;
    public $organization_id;




    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'organization_id'], 'required'],
            [['organization_id', 'organization_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'login', 'email'], 'string', 'max' => 255],
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
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'login' => 'Login',
            'email' => 'Email',
            'password' => 'Password',

            'organization_id' => 'organization_id ',
        ];
    }

/**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[Applications0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications0()
    {
        return $this->hasMany(Application::class, ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Applicationstuds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationstuds()
    {
        return $this->hasMany(Applicationstud::class, ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Applicationstuds0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplicationstuds0()
    {
        return $this->hasMany(Applicationstud::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[AuthAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

        /**
     * Gets query for [[ItemNames]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'id']);
    }



    /**
     * Gets query for [[Organizations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganizations()
    {
        return $this->hasMany(Organization::class, ['employer_id' => 'id']);
    }

    /**
     * Gets query for [[Specialization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(Specialization::class, ['id' => 'specialization_id']);
    }

    /**
     * Gets query for [[StudentGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentGroup()
    {
        return $this->hasOne(StudentGroup::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[StudentLists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentLists()
    {
        return $this->hasMany(StudentLists::class, ['student_id' => 'id']);
    }
 /**
    * Gets query for [[EmployerLists]].
    *
    * @return \yii\db\ActiveQuery
    */
    public function getEmployerLists()
    {
        return $this->hasMany(EmployerLists::class, ['employer_id' => 'id']);
    }
        /**
     * Gets query for [[StudentPractices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentPractices()
    {
        return $this->hasMany(StudentPractice::class, ['student_id' => 'id']);
    }

    /**
     * Gets query for [[StudentResumes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStudentResumes()
    {
        return $this->hasMany(StudentResume::class, ['student_id' => 'id']);
    }

     /**
     * Gets query for [[UserInterprises]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInterprises()
    {
        return $this->hasMany(UserInterprise::class, ['user_id' => 'id']);
    }
    
    

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->password = \Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($login)
    {
        return static::findOne(['login'=>$login]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }


    // public function getIsAdmin() 
    // {
    //     return $this->role_id == Role::getRoleId('admin');
    // }

    public function getIsAdmin() 
    {
        return \Yii::$app->user->can('can_admin');
    }

    

    public function getFullName()
    {
        return $this->surname . ' ' . $this->name . ' ' . $this->patronymic;
    }

    public static function getStudentList($group_id)
    {
        return static::find()->select(['CONCAT(surname,\' \',name,\' \',patronymic)'])
        ->join('INNER JOIN', 'student_group', 'user.id = student_group.student_id')
        ->where(['group_id' => $group_id])->indexBy('id')->column();
    }

}
