<?php

namespace app\controllers;

use Yii;
use app\models\Books;
use app\models\BooksSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * BooksController implements the CRUD actions for Books model.
 */
class BooksController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex()
    {

        $session = Yii::$app->session;
        $session->remove('redirect_param');

        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Books();

        $session = Yii::$app->session;
        if (strripos($_SERVER['HTTP_REFERER'], 'BooksSearch') || strripos($_SERVER['HTTP_REFERER'], 'sort')){$session->set('redirect_param', $_SERVER['HTTP_REFERER']);}

        if ($model->load(Yii::$app->request->post())) {
            $file_image = UploadedFile::getInstance($model, 'image');

            if ($file_image && $file_image->tempName) {
                $model->image = $file_image;
                if ($model->validate(['image'])){

                    $base_patch = 'uploads/';
                    $dir = Yii::getAlias('../web/'.$base_patch);

                    $fileName = $model->image->baseName . '.' . $model->image->extension;
                    $model->image->saveAs($dir . $fileName);
                    $model->image = $fileName;
                    $model->image = $dir . $fileName;

                    $model->preview = $base_patch.$fileName;
                }
            }


            if ($model->save()) {
                return  $this->redirect($session->get('redirect_param'));
                //return $this->redirect(['view', 'id' => $model->id]);
        }} else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $session = Yii::$app->session;
        if (strripos($_SERVER['HTTP_REFERER'], 'BooksSearch') || strripos($_SERVER['HTTP_REFERER'], 'sort')){$session->set('redirect_param', $_SERVER['HTTP_REFERER']);}

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $file_image = UploadedFile::getInstance($model, 'image');

            if ($file_image && $file_image->tempName) {
                $model->image = $file_image;
                if ($model->validate(['image'])){

                    $base_patch = 'uploads/';
                    $dir = Yii::getAlias('../web/'.$base_patch);
                    $fileName = $model->image->baseName . '.' . $model->image->extension;
                    $model->image->saveAs($dir . $fileName);
                    $model->image = $fileName;
                    $model->image = $dir . $fileName;

                    $model->preview = $base_patch.$fileName;
                }
            }

            if ($model->save()) {

                return ((isset($session['redirect_param']))?($this->redirect($session->get('redirect_param'))):($this->redirect(['index'])));
            //return $this->redirect(['view', 'id' => $model->id]);
        }} else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjax(){
        $request = Yii::$app->request;
        $post = $request->post();
        $returnArray = [];
        if ( $model = $this->findModel($post['id']) ){
            $returnArray['author'] = \app\models\Authors::getAuthorsName($model->author_id);
            $returnArray['name'] = $model->name;
            $returnArray['preview'] = $model->preview;
            $returnArray['date_create'] = $model->date_create;
            $returnArray['date_update'] = $model->date_update;
            $returnArray['date'] = $model->date;
        }


        echo json_encode($returnArray);
        exit();
    }

}
