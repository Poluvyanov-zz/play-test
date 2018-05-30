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

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function create($params)
    {
        if ($this->validate()) {

            $task = new Task();
            $task->task = $this->task;
            $task->save();

            return true;
        }
        return false;
    }
}
