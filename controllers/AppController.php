<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class AppController extends Controller
{
    public function beforeAction($action)
    {
        
        if(!Yii::$app->session->isActive){
            Yii::$app->session->open();
        }

        
        if(!parent::beforeAction($action)){
            return false;
        }

        return true;
    }
}