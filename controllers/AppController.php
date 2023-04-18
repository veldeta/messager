<?php

namespace app\controllers;

use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;

class AppController extends Controller
{
    public function beforeAction($action)
    {
        
        if(!Yii::$app->session->isActive){
            Yii::$app->session->open();
        }

        if(Yii::$app->user->isGuest && $action->actionMethod != 'actionLogin'){
            return $this->redirect(['site/login']);
        }

        // VarDumper::dump($action,10,true);
        if(!parent::beforeAction($action)){
            return false;
        }
        
        
        return true;
    }
}