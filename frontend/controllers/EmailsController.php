<?php

namespace frontend\controllers;

use Yii;
use app\models\Emails;
use app\models\EmailsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
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
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emails();
    
    if ($model->load(Yii::$app->request->post())){
        $model ->attachment = UploadedFile::getInstance($model,'attachment');
        if($model -> attachment){
         // for saving in db
            $time = time();
            $model ->attachment->saveAs('attachment/'.$time.'.'.$model->attachment->extension);
            $model ->attachment = 'attachment/'.$time.'.'.$model->attachment->extension;
        }
        if($model -> attachment){
     //       echo '<pre>';
       //     print_r($model);
         //   echo '</pre>';
           // die();
            // if email with attachment for swiftemailer
            $value = Yii:: $app->mailer->compose()
            -> setFrom(['tester.tester.tester1988@gmail.com'])
            -> setTo([$model->receiver_email])
            ->setSubject($model->subject)
            ->setHtmlBody($model->content)
            -> attach($model->attachment)
            ->send();
        }else{
            // if emailout attachment for swiftemailer
            $value = Yii:: $app -> mailer -> compose()
            -> setFrom(['tester.tester.tester1988@gmail.com'])
            -> setTo([$model->receiver_email])
            ->setSubject($model->subject)
            ->setHtmlBody($model->content)
            ->send();
        }
        $model->save();
        if ( $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

    }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Emails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Emails model.
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
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
