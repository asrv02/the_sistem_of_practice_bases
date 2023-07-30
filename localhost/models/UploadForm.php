<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $reportFile;

    public function rules()
    {
        return [
            [['reportFile'], 'file', 'skipOnEmpty' => false, 
            //'checkExtensionByMimeType' => false
            'extensions'=> 'docx'
        ],
        ];
    }
    
    public function upload()
    {
        
        if ($this->validate()) {
            
            $fileName = Yii::$app->user->id . '_' . time() . '_' . mb_ereg_replace('/\s/', '_', $this->reportFile->baseName) . '.' . $this->reportFile->extension;
            $this->reportFile->saveAs($fileName);
            return $fileName;
        } else {
            return false;
        }
    }
}