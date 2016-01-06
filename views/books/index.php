<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Новая запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        $label = new \app\models\Books;
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => '',
        'columns' => [


            'id',
            'name',
            [
                'label'=>$label->getAttributeLabel('preview'),
                'attribute' => 'preview',
                'format' => 'raw',
                'value'=>function ($data) {
                    $img_src = '/images/nophoto_100_100.jpg';
                    if (!empty($data->preview) && file_exists('../web/'.$data->preview)){
                        $img_src = $data->preview;
                    }
                    return '
                    <a class="single_image" href="#"><img src="'.$img_src.'" style="width:100px;" alt=""/></a>';
                },
                'filter' => '',
            ],


            [
                'label'=>$label->getAttributeLabel('author_id'),
                'attribute' => 'author_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return \app\models\Authors::getAuthorsName($data->author_id);
                },
                'filter' => '',
            ],

            [
                'label'=>$label->getAttributeLabel('date'),
                'attribute' => 'date',
                'format' => 'raw',
                'value'=>function ($data) {
                    return \app\models\Books::returnDate($data->date);
                },
                'filter' => '',
            ],

            [
                'label'=>$label->getAttributeLabel('date_create'),
                'format' => 'raw',
                'attribute' => 'date_create',
                'value'=>function ($data) {
                    return \app\models\Books::returnDate($data->date_create);
                },
                'filter' => '',
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Кнопки действий',
                'template' => '{update} {view} {delete}',
                'buttons' => [

                    //view button
                    'view' => function ($url, $model) {
                        return Html::a('<span data-id="'.$model->id.'" class="show_modal_books_edit glyphicon glyphicon-eye-open"></span>', $url, [
                        ]);
                    },
                ],


            ],
        ],
    ]); ?>

</div>

