<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "description".
 *
 * @property int $id
 * @property string $avatar
 * @property string $des
 * @property string $status
 * @property int $user_id
 *
 * @property User $user
 */
class Description extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'description';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['avatar', 'des', 'status', 'user_id'], 'required'],
            [['des'], 'string'],
            [['user_id'], 'integer'],
            [['avatar', 'status'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'avatar' => 'Avatar',
            'des' => 'Des',
            'status' => 'Status',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
