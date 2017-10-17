<?php

namespace backend\controllers;

use Yii;
use app\models\Vendor;
use app\models\VendorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\States;
use app\models\Cities;
use app\models\Countries;


/**
 * VendorController implements the CRUD actions for Vendor model.
 */
class VendorController extends Controller
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
     * Lists all Vendor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VendorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /* For change in country dropdown */
    public function actionPhonecodecountry($id){
        $country = Countries::find()
                ->where(['id' => $id])
                ->orderBy('id')
                ->one();
                $countCountry  = count($country);
        if($countCountry>0){
            echo $country->phonecode;
        }
    }

    public function actionStatescountry($id){
         $states = States::find()
                ->where(['country_id' => $id])
                ->orderBy('id')
                ->all();
        $count  = count($states);
        if($count>0){
            foreach($states as $state){
                echo "<option value='".$state->id."'>".$state->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }
    }    
    public function actionCitiescountry($id){

         $states = States::find()
                ->where(['country_id' => $id])
                ->orderBy('id')
                ->all();
        $count  = count($states);
        if($count>0){
            foreach($states as $state){
                $cities = Cities::find()
                        ->where(['state_id' => $state->id])
                        ->orderBy('id')
                        ->all();
                $countCities  = count($cities);
                if($countCities>0){
                     foreach($cities as $city){
                        echo "<option value='".$city->id."'>".$city->name."</option>";
                    }
                }
            }
        }
        else{
            echo "<option>-</option>";
        }
    }

    /** For change in state dropdown */
    public function actionCountrystate($id){
        $countryId = States::find()->where(['id' => $id])->one();
        echo $countryId->country_id;
    }

    public function actionCitiesstate($id){
        $cities = Cities::find()
                ->where(['state_id' => $id])
                ->orderBy('id')
                ->all();
        $countCities  = count($cities);
        if($countCities>0){
                foreach($cities as $city){
                echo "<option value='".$city->id."'>".$city->name."</option>";
            }
        }
        else{
            echo "<option>-</option>";
        }

    }

    /** If city changed */
    public function actionCitychanged($id){
        $cityId = Cities::find()
                ->where(['id' => $id])
                ->one();
        echo $cityId->state_id;
    }

    public function actionExperimental($id)
    {
        $country = Countries::find()
                ->where(['id' => $id])
                ->orderBy('id')
                ->one();
        $states = States::find()
                ->where(['country_id' => $id])
                ->orderBy('id')
                ->all();
        $countStates  = count($states);
        if($countStates>0){
            echo "{'phonecode':'".$country->phonecode."','states':[{";
                $i =0;
            foreach($states as $state){
                echo (($i != 0)?",":"").
                "'state_id':'".$state->id."','state_name':'".$state->name."','cities':{";
                $cities = Cities::find()
                        ->where(['state_id' => $state->id])
                        ->orderBy('id')
                        ->all();
                $countCities  = count($cities);
                if($countCities>0){
                    $j = 0;
                    foreach($cities as $city){
                        echo (($j != 0)?",":"").
                        "'city_id':'".$city->id."' ,'city_name':'".$city->name."'";
                        $j++;
                    }
                }
                echo "}";
                $i ++;
            }
            echo "}]}";
        }
    }    

    /**
     * Displays a single Vendor model.
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
     * Creates a new Vendor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Vendor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Vendor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Vendor model.
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
     * Finds the Vendor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Vendor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Vendor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
