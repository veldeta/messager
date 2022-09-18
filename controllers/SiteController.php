<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\{RegForm, LoginForm};
use yii\helpers\VarDumper;

class SiteController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                ],

            ],
            
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionReg()
    {
        $model = new RegForm();

        // VarDumper::dump(Yii::$app->session->get('step1'),10,true);
        // die;
        if(Yii::$app->request->isPost){
            if($model->load($this->request->post()))
                
                if(!Yii::$app->session->has('step1') ){
                    Yii::$app->session->set('step1', ['name' => $model->name, 'surname' => $model->surname]);
                    // VarDumper::dump($model,10,true);
                    // VarDumper::dump(Yii::$app->session->get('reg'),10,true);
                    // die;

                    return $this->render('step2', compact('model'));
                }
                if(!Yii::$app->session->has('step2')){
                    Yii::$app->session->set('step2', ['password' => $model->password]);
                    return $this->render('step3', compact('model'));
                }
                if(!Yii::$app->session->has('step3')){
                    Yii::$app->session->set('step3', ['login' => $model->login, 'email' => $model->email]);
                    $this->codeEmal($model->email);
                    return $this->render('step4', compact('model'));
                }
                if(!Yii::$app->session->has('step4')){
                    if(Yii::$app->security->validatePassword($model->text, Yii::$app->session->get('code'))){
                        Yii::$app->session->set('step4', ['emailT' => true]);
                        VarDumper::dump( $model, $depth = 10, $highlight = true);
                        die;
                    }
                    return $this->render('step4', compact('model'));
                }
            
        }

        return $this->render('reg', compact('model'));
    }

    public function codeEmal($email)
    {
        $code = Yii::$app->security->generateRandomString(10);
        Yii::$app->mailer->compose()
            ->setFrom('terminatorslava38@mail.ru')
            ->setTo($email)
            ->setSubject('Сообщение с кодом подтверждения')
            ->setTextBody($code)
            ->send();
        
        Yii::$app->session->set('code', Yii::$app->security->generatePasswordHash($code));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
