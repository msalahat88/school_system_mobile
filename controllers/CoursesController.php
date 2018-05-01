<?php
/**
 * Created by PhpStorm.
 * User: salahat
 * Date: 21/04/18
 * Time: 09:08 م
 */
namespace app\controllers;
use yii\rest\ActiveController;
class CoursesController extends ActiveController{
    public $modelClass = 'app\models\Courses';
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
}