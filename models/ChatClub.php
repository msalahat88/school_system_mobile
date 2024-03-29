<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_club".
 *
 * @property int $id
 * @property string $message
 * @property int $sender_id
 * @property int $club_student_id
 * @property int $club_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $sender
 * @property ClubStudent $clubStudent
 * @property Club $club
 */
class ChatClub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chat_club';
    }
    public function beforeValidate(){
        $this->created_at = time();
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {

        $this->created_at = time();

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message','club_id', 'sender_id', 'club_student_id', 'created_at'], 'required'],
            [['message'], 'string'],
            [['sender_id', 'club_student_id', 'created_at', 'updated_at'], 'integer'],
            [['sender_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['sender_id' => 'id']],
            [['club_student_id'], 'exist', 'skipOnError' => true, 'targetClass' => ClubStudent::className(), 'targetAttribute' => ['club_student_id' => 'id']],
            [['club_id'], 'exist', 'skipOnError' => true, 'targetClass' => Club::className(), 'targetAttribute' => ['club_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'message' => Yii::t('app', 'Message'),
            'sender_id' => Yii::t('app', 'Sender ID'),
            'club_student_id' => Yii::t('app', 'Club Student ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClubStudent()
    {
        return $this->hasOne(ClubStudent::className(), ['id' => 'club_student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClub()
    {
        return $this->hasOne(Club::className(), ['id' => 'club_id']);
    }

    /**
     * @inheritdoc
     * @return ChatClubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChatClubQuery(get_called_class());
    }
}
