<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ShiftForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
$this->title = 'Добавить задание';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (Yii::$app->session->hasFlash('TaskFormSubmitted')): ?>
        Задание успешно добавлено!
    <?php else: ?>


        <?php $form = ActiveForm::begin(['id' => 'task-form']); ?>


        <?= $form->field($model, 'task') ?>


        <div class="form-group">
            <?= Html::submitButton('Создать предложение', ['class' => 'btn btn-primary', 'name' => 'shift-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>