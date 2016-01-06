<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Books */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>


    <?= $form->field($model, 'author_id')->dropDownList(\app\models\Authors::getAuthorsName());?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>


    <?php
        if (!$model->isNewRecord && !empty($model->preview)){
            if (file_exists('../web/'.$model->preview)){
                echo '<img src="/'.$model->preview.'" style="width: 100px;" />';
            }
        }
    ?>
    <?=$form->field($model, 'image')->fileInput() ?>


    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'language' => 'ru',
    ]) ?>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="/books" class="btn">Отмена</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
