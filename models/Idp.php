<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

use yii\helpers\BaseFileHelper;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

use Yii;

class Idp extends \yii\db\ActiveRecord
{

    const UPLOAD_FOLDER = '/uploads/idp/';
    public $urlfiles ='/uploads/idp';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idp_proj';
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'],'unique','message'=>'Name already exist. Please try another one.'],
            [['date_idp'], 'date'],
            [['name', 'num', 'created_at', 'updated_at'], 'string', 'max' => 255],
            [['photo'], 'file', 'extensions' => 'png, jpg', 'maxSize'=> 1024 * 1024 * 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [           
            
    'id' => 'id',
    'name' => 'name',
    'date_idp' => 'date_idp',
    'num' => 'num',
        ];
    }
    
    public function getCountAll()
    {        
        return Idp::find()->count();           
    }

    public static function getUploadPath(){
        return Yii::getAlias('@webroot').'/'.self::UPLOAD_FOLDER.'/';
    }
    
    public static function getUploadUrl(){
        return Url::base(true).'/'.self::UPLOAD_FOLDER.'/';
    }
    
    private function uploadSingleFile($model,$tempFile=null){
        $file = [];
        $json = '';
        try {
             $UploadedFile = UploadedFile::getInstance($model,'photo');
             if($UploadedFile !== null){
                 $oldFileName = $UploadedFile->basename.'.'.$UploadedFile->extension;
                 $newFileName = md5($UploadedFile->basename.time()).'.'.$UploadedFile->extension;
                 $UploadedFile->saveAs(Co::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                 $file[$newFileName] = $oldFileName;
                 $json = Json::encode($file);
             }else{
                $json=$tempFile;
             }
        } catch (Exception $e) {
            $json=$tempFile;
        }
        return $json ;
    }

    private function uploadMultipleFile($model,$tempFile=null){
        $files = [];
        $json = '';
        $tempFile = Json::decode($tempFile);
        $UploadedFiles = UploadedFile::getInstances($model,'docs');
        if($UploadedFiles!==null){
           foreach ($UploadedFiles as $file) {
               try {   $oldFileName = $file->basename.'.'.$file->extension;
                       $newFileName = md5($file->basename.time()).'.'.$file->extension;
                       $file->saveAs(Freelance::UPLOAD_FOLDER.'/'.$model->ref.'/'.$newFileName);
                       $files[$newFileName] = $oldFileName ;
               } catch (Exception $e) {

               }
           }
           $json = json::encode(ArrayHelper::merge($tempFile,$files));
        }else{
           $json = $tempFile;
        }
       return $json;
}
}
