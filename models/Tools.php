<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tools".
 *
 * @property int $id
 * @property string $title
 * @property int $courses_id
 * @property int $teacher_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Courses $courses
 * @property User $teacher
 */
class Tools extends \yii\db\ActiveRecord
{
    public function beforeValidate()
    { $this->created_at = time();
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
    public static function tableName()
    {
        return 'tools';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'courses_id', 'teacher_id', 'created_at'], 'required'],
            [['title'], 'string'],
            [['courses_id', 'teacher_id', 'created_at', 'updated_at'], 'integer'],
            [['courses_id'], 'exist', 'skipOnError' => true, 'targetClass' => Courses::className(), 'targetAttribute' => ['courses_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'courses_id' => Yii::t('app', 'Courses ID'),
            'teacher_id' => Yii::t('app', 'Teacher ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasOne(Courses::className(), ['id' => 'courses_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }

    /**
     * @inheritdoc
     * @return ToolsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ToolsQuery(get_called_class());
    }
}
