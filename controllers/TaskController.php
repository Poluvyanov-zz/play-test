<?php

namespace app\controllers;

use app\models\TaskForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new TaskForm();
        if ($model->load(Yii::$app->request->post()) && $model->create(Yii::$app->request->post())) {
            Yii::$app->session->setFlash('TaskFormSubmitted');
            return $this->refresh();
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }





}

