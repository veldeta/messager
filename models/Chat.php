<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat".
 *
 * @property int $id
 * @property int $mess_id
 * @property int $user_id
 * @property int $message_id
 *
 * @property Mess $mess
 * @property Message $message
 * @property User $user
 */
class Chat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mess_id', 'user_id', 'message_id'], 'required'],
            [['mess_id', 'user_id', 'message_id'], 'integer'],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => Message::className(), 'targetAttribute' => ['message_id' => 'id']],
            [['mess_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mess::className(), 'targetAttribute' => ['mess_id' => 'id']],
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
            'mess_id' => 'Mess ID',
            'user_id' => 'User ID',
            'message_id' => 'Message ID',
        ];
    }

    /**
     * Gets query for [[Mess]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMess()
    {
        return $this->hasOne(Mess::className(), ['id' => 'mess_id']);
    }

    /**
     * Gets query for [[Message]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(Message::className(), ['id' => 'message_id']);
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
