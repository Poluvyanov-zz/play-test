<?php

namespace app\controllers;

use app\models\Task;
use app\models\TaskForm;
use app\models\User;
use Yii;
use yii\db\Expression;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;

class PlayController extends Controller
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
                        'roles' => ['@'],
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
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $task = Task::find()->orderBy(new Expression('rand()'))->one();
        $task_words = $this->toArray($task->task);
//
//        $words_from_frontend = 'Второе задание!';
//
//        $string_from_front =  $this->toArray($words_from_frontend);
//
//     var_dump('ЗАДАНИЕ',$task->task);
//
//        $final = array_intersect($task_words, $string_from_front);
//
//        if($final == TRUE){
//            var_dump('ВСЁ ВЕРНО, ПОЗДРАВЛЯЕМ И ЗАПИСЫВАЕМ'); die();
//        }
//        else{
//            var_dump($words_from_frontend, $task_words, 'FUCK'); die();
//        }




var_dump( $this->MySort($task_words)); die();

        return $this->render('index', [
                'model' => $this->shuffle_assoc($task_words)
        ]);

    }

    public function toArray($string){
        $words = preg_split("/[\s,]+/", $string);
        $number_words = [];
        foreach ($words as $key => $value){
            $number_words[$key] = $value;
        }

        return $number_words;
    }


    public function MySort($arr) {
        $keys = array_keys($arr);
        shuffle($keys);

        $result = []; $i = 0;
        foreach ($arr as $item)
            $result[$keys[$i++]] = $item;

        return $result;
    }

}

