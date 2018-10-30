<?php

namespace app\controllers;

use Yii;
use app\models\Idp;
use app\models\IdpFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ProfileController implements the CRUD actions for Profile model.
 */
class IdpController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create'],
                'rules' => [
                    [
                        'actions' => ['index','create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Profile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Idp::find()->orderBy([
            'created_at'=>SORT_ASC,
            'id' => SORT_DESC,
            ])->limit(50)->all();
        
        $model2 = IdpFile::find()->orderBy([
                'created_at'=>SORT_ASC,
                'id_file' => SORT_DESC,
                ])->limit(50)->all();
        
        $countAll = Idp::getCountAll();
        
        return $this->render('index',[
            'models' => $model,
            'models2' => $model2,
            'countAll' => $countAll,
        ]);
    }

    /**
     * Displays a single Profile model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('view',[
                    'model' => $this->findModel($id),                   
            ]);
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Profile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() // md5(rand().time("now")
    {      
        $model = new Idp();
        $model2 = new IdpFile();
        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 
     
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->date_idp = date('Y-m-d H:i:s', time("now"));
        //    echo "<script>alert('There are no fields to generate a report');</script>";
            $model->created_at = 'strtotime(time("now"))';
            if($model->save()){
               return $this->redirect(['index']);
            }   
        }

        // $model->tel = explode(',', $model->tel);
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('create',[
                    'model' => $model,
                    'model2' => $model2,                    
            ]);
        }else{
            return $this->render('create',[
                'model' => $model,
                'model2' => $model2,                    
            ]); 
        }
    }   
    
    public function actionFileinsert() // md5(rand().time("now")
    {      
        $model = new Idp();
        $model2 = new IdpFile();
        return $this->renderAjax('_form_fileinsert',[
            'model' => $model,
            'model2' => $model2,                    
        ]); 

    }  

    public function actionFileinsertsave() // md5(rand().time("now")
    {      
        $model = new Idp();
        $model2 = new IdpFile();
        return $this->renderAjax('_form_create',[
            'model' => $model,
            'model2' => $model2,                    
        ]); 

    }  

    /**
     * Updates an existing Profile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $filename = $model->photo;

        //Add This For Ajax Email Exist Validation 
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
          } 

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $f = UploadedFile::getInstance($model, 'photo');

            if(!empty($f)){
                
                $dir = Url::to('@webroot/uploads/contact/');
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }                
                if($filename && is_file($dir.$filename)){
                    unlink($dir.$filename);// ลบ รูปเดิม;                   
                    
                }
                $fileName = md5($f->baseName . time()) . '.' . $f->extension;
                if($f->saveAs($dir . $fileName)){
                    $model->photo = $fileName;
                }
                $model->save();   
                return $this->redirect(['index', 'id' => $filename]);                            
            }
            $model->photo = $filename;
            $model->save();          
            return $this->redirect(['index', 'id' => $filename]);
        }
        if(Yii::$app->request->isAjax){
            return $this->renderAjax('update',[
                    'model' => $model,                    
            ]);
        }
        
        return $this->render('update',[
               'model' => $model,                    
        ]); 
        
    }

    /**
     * Deletes an existing Profile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $filename = $model->photo;
        $dir = Url::to('@webroot/uploads/contact/');
        
        if($filename && is_file($dir.$filename)){
            unlink($dir.$filename);// ลบ รูปเดิม;                    
        }
        
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Profile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Profile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Idp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
