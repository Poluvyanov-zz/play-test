<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class TaskForm extends Model
{
    public $task;

    public function attributeLabels() {
        return [
            'task' => 'Введите текст'
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // task is required
            [['task'], 'required'],

        ];
    }


    public function create($params)
    {
        if (!$this->validate())
            return false;

        foreach ($this->DividedIntoSentences($this->task) as $key => $value) {
            $task = new Task();
            $task->task = $value;
            $task->save();
        }




        return true;


    }


    public function DividedIntoSentences($text)
    {
        $items = preg_split("/[.?!] /", $text);

        foreach ($items as $key => $value) {
            if (!(str_word_count($value) > 3))
                continue;
            $sentences[] = $value;

        }

        return $sentences;
    }
}
