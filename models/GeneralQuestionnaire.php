<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_questionnaire".
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GeneralQuestionnaireAnswers[] $generalQuestionnaireAnswers
 * @property GeneralUserQuestionnaireAnswers[] $generalUserQuestionnaireAnswers
 */
class GeneralQuestionnaire extends \yii\db\ActiveRecord
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
        return 'general_questionnaire';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'created_at'], 'required'],
            [['title', 'type'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralQuestionnaireAnswers()
    {
        return $this->hasMany(GeneralQuestionnaireAnswers::className(), ['general_questionnaire_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralUserQuestionnaireAnswers()
    {
        return $this->hasMany(GeneralUserQuestionnaireAnswers::className(), ['general_questionnaire_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GeneralQuestionnaireQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneralQuestionnaireQuery(get_called_class());
    }
}