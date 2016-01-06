<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\BooksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="books-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'author_id')->dropDownList(\app\models\Authors::getAuthorsName());?>

    <?= $form->field($model, 'name') ?>


    <?= $form->field($model, 'date_start')->widget(DatePicker::classname(), [
        'language' => 'ru',
    ]) ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::classname(), [
        'language' => 'ru',
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton('Искать', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<HR>
