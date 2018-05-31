<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\ShiftForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\Pjax;

$this->title = 'Игра';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">

                <?php Pjax::begin(); ?>
                <?= Html::beginForm(['play/check'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
                <?= Html::hiddenInput('task_id', $task_id) ?>
                <?= Html::hiddenInput('string', Yii::$app->request->post('string'), ['class' => 'form-control', 'id' => 'play']) ?>
                <?= Html::hiddenInput('origin_task', $origin_task, ['class' => 'form-control', 'id' => 'play']) ?>
                <?php if ($button) : ?>
                    <?= Html::submitButton('Проверить', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button', 'id' => 'send']) ?>
                <?php endif; ?>
                <?= Html::endForm() ?>
                <h3><?= $stringHash ?></h3>

                <?php if ($button) : ?>
                    <div class="droptarget" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <?php foreach ($model as $key => $value): ?>
                            <p ondragstart="dragStart(event)" draggable="true"
                               id="dragtarget<?= $key ?>"><?= $value ?></p>

                        <?php endforeach; ?>
                    </div>


                    <div class="droptarget-result" ondrop="dropResult(event)" ondragover="allowDrop(event)"></div>


                <?php else : ?>
                    <h2><?= $origin_task ?></h2><?= Html::a('Новая игра', ['/play/index'], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>

                <script>
                    var a = '';

                    function dragStart(event) {
                        event.dataTransfer.setData("Text", event.target.id);
                    }

                    function allowDrop(event) {
                        event.preventDefault();
                    }

                    function drop(event) {

                        event.preventDefault();
                        var data = event.dataTransfer.getData("Text");
                        event.target.appendChild(document.getElementById(data));
                        a = a.replace(event.target.appendChild(document.getElementById(data)).textContent, "");
                        $('#play').val(a);
                    }

                    function dropResult(event) {
                        event.preventDefault();
                        var data = event.dataTransfer.getData("Text");
                        event.target.appendChild(document.getElementById(data));
                        a += event.target.appendChild(document.getElementById(data)).textContent + ' ';
                        $('#play').val(a);
                    }
                </script>

                <?php Pjax::end(); ?>

            </div>
        </div>
    </div>
</div>


<style>
    .droptarget {
        float: left;
        width: 300px;
        height: 205px;
        margin: 0;
        padding: 10px;
        border: 0;
        font-size:20px;
    }

    .droptarget-result {
        float: left;
        width: 500px;
        height: 205px;
        margin: 15px;
        padding: 10px;
        border: 1px solid #aaaaaa;
    }
</style>











