<?php
/**
 * Created by PhpStorm.
 * User: Ivany
 * Date: 25.05.2016
 * Time: 20:24
 */

namespace app\controllers;

use app\models\ReportsModel;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class ReportController extends ActiveController
{
    public $modelClass = 'app\models\ReportsModel';


}