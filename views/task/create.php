<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Генерация заданий';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>


    <?php if (Yii::$app->session->hasFlash('TaskFormSubmitted')): ?>
        Задание успешно добавлено!
    <?php else: ?>


        <?php $form = ActiveForm::begin(['id' => 'task-form']); ?>



        <?= $form->field($model, 'task')->textarea(['rows' => '6']) ?>


        <div class="form-group">
            <?= Html::submitButton('Генерировать задания', ['class' => 'btn btn-primary', 'name' => 'shift-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    <?php endif; ?>
</div>

<!--11-->