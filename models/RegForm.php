<?php

namespace app\models;

use yii\base\Model;

class RegForm extends Model
{
    public $name;
    public $surname;
    public $login;
    public $password;
    public $password_repet;
    public $email;
    public $rules;
    public $text;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'surname', 'login', 'password', 'password_repet'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],

            [['name'], 'match', 'pattern' => '/^[А-ЯЁа-яё]+$/u'],

            [['surname'], 'match', 'pattern' => '/^[А-ЯЁа-яё]+|([А-ЯЁа-яё]+[\-]([А-ЯЁа-яё]+))$/u'],

            [['login'], 'match', 'pattern' => '/^[A-Za-z0-9]+$/u'],

            [['password'], 'match', 'pattern' => '/^\S+$/u'],
            
            ['password_repet', 'compare', 'compareAttribute' => 'password'],
            
            ['rules', 'compare', 'compareValue' => 1],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            "name"=>"Имя",
            "surname"=>"Фамилия",
            "login"=>"Логин",
            "password"=>"Пароль",
            "password_repet"=>"Подтверждения пароля",
            "email"=>"Email",
            "rules"=>"Соглашение с правами регистарции",
        ];
    }
}