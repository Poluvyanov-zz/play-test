<?php
/* @var $this yii\web\View */
$this->title = 'Игра';
?>

<div class="site-index">

    <div class="jumbotron">



    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <textarea name="play" id="play" cols="80" rows="5"></textarea>


                <?php foreach ($model as $word): ?>
                    <p onclick="takeWord(this.innerHTML)"> <?=$word->task ?></p>

                <?php endforeach;?>
            </div>

        </div>

    </div>
</div>





<script>

    function takeWord(data) {
        $("textarea").val($( "textarea").val() + " "+data);
    }

</script>
