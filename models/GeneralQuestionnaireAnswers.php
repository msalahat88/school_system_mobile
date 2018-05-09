<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_questionnaire_answers".
 *
 * @property int $id
 * @property int $general_questionnaire_id
 * @property string $title
 * @property int $created_at
 * @property int $updated_at
 *
 * @property GeneralQuestionnaire $generalQuestionnaire
 * @property GeneralUserQuestionnaireAnswers[] $generalUserQuestionnaireAnswers
 */
class GeneralQuestionnaireAnswers extends \yii\db\ActiveRecord
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
        return 'general_questionnaire_answers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['general_questionnaire_id', 'title', 'created_at'], 'required'],
            [['general_questionnaire_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string'],
            [['general_questionnaire_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralQuestionnaire::className(), 'targetAttribute' => ['general_questionnaire_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'general_questionnaire_id' => Yii::t('app', 'General Questionnaire ID'),
            'title' => Yii::t('app', 'Title'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralQuestionnaire()
    {
        return $this->hasOne(GeneralQuestionnaire::className(), ['id' => 'general_questionnaire_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeneralUserQuestionnaireAnswers()
    {
        return $this->hasMany(GeneralUserQuestionnaireAnswers::className(), ['general_questionnaire_answers_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return GeneralQuestionnaireAnswersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneralQuestionnaireAnswersQuery(get_called_class());
    }
}
