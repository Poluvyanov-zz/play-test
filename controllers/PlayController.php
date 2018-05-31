<?php

namespace app\controllers;

use app\models\Score;
use app\models\Status;
use app\models\Task;
use app\models\TaskForm;
use app\models\User;
use Yii;
use yii\base\Security;
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
        $stringHash = '';

        return $this->render('index', [
            'model' => $this->shuffle_assoc($task_words),
            'stringHash' => $stringHash,
            'task_id' => $task->id,
            'button' => true,
            'origin_task' => $task->task
        ]);

    }




    public function actionCheck()
    {
        if (!Yii::$app->request->post())
            return $this->redirect(['play/index']);

        $task = Task::find()->where(['id' => Yii::$app->request->post('task_id')])->one();

        $task_words = $this->toArray($task->task);

        $word_from_front = $this->toArray(Yii::$app->request->post('string'));

        $check_result = $task_words == $word_from_front;

        if ($check_result === true)
            $this->writeWin($task->id);


        return $this->render('index', [
            'model' => $this->shuffle_assoc($task_words),
            'stringHash' => $check_result === true ? 'Вы распознали замысел автора!' : 'Увы, но автор думал иначе',
            'task_id' => $task->id,
            'button' => false,
            'origin_task' => $task->task
        ]);


    }




    public function writeWin($task_id)
    {
        $score = new Score();
        $score->task_id = $task_id;
        $score->status_id = Status::find()->where(['name' => 'win'])->one()->id;
        $score->user_id = Yii::$app->user->identity->id;
        $score->save();
    }


    public function toArray($string)
    {
        $string = trim($string);
        $words = preg_split("/[\s,]+/", $string);
        $number_words = [];
        foreach ($words as $key => $value) {
            $number_words[$key] = $value;
        }

        return $number_words;
    }


    function shuffle_assoc($list)
    {
        if (!is_array($list)) return $list;

        $keys = array_keys($list);
        shuffle($keys);
        $random = array();
        foreach ($keys as $key)
            $random[$key] = $list[$key];

        return $random;
    }
}

