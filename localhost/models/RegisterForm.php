<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $login;
    public $email;
    public $password;
    public $password_repeat;
    public $organization_id;
    public $post_id;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'login', 'email', 'password', 'password_repeat','post_id','organization_id'], 'required'],
            [['name', 'surname', 'patronymic', 'login', 'email', 'password', 'password_repeat'], 'string', 'max'=>255],
            [['password', 'password_repeat'], 'string', 'min'=>6],
            [['login', 'email'], 'unique', 'targetClass'=>User::class],
            ['password_repeat', 'compare', 'compareAttribute'=>'password'],
            
            ['email', 'email'],
            [['organization_id', 'post_id'], 'integer'],
            // ['login', 'match', 'pattern'=>'/^[\w]+$/'],
            // [['name', 'surname', 'patronymic'], 'match', 'pattern'=>'/^[а-яА-ЯёЁ\-\s]+$/u'],
            // [['phone'], 'udokmeci\yii2PhoneValidator\PhoneValidator', 'country'=>'RU'],   // валидация телефона
        ];
    }

   

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function registerUser()
    {
        if ($this->validate()) {
            $user = new User();
            $auth = Yii::$app->authManager;
            
            if($user->load($this->attributes, '')){
                $user->save(false);
                if( !$model = UserInterprise::findOne(['user_id' => $user->id, 'organization_id' => $this->organization_id]) ) {
                    $model = new UserInterprise();
                    $model->user_id = $user->id;
                }
                $model->organization_id = $this->organization_id;
                $model->post_id = $this->post_id;                

                $model->save();

                Yii::$app->session->setFlash('success', 'Пользователь успешно создан!');
                    $auth->assign($auth->getRole('employer'), $user->getId());    
            }
            
        }
        return $user ?? false;
    }
}
