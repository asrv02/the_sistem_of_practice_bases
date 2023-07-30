<?php

namespace app\models;


use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use ZipArchive;

/**
 * This is the model class for table "documents".
 *
 * @property int $id
 * @property string $doki

 *
 * @property Practice[] $practices
 */
class Documents extends \yii\db\ActiveRecord
{
    public $files;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    public function getFileNames() {
        return [
            'doki' => 'dokiy',

        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $fileNames = array_keys($this->getFileNames());

        return [
            [[ 'view_practice_id'], 'required'],
            [['view_practice_id'], 'integer'],
            [['doki'], 'string', 'max' => 255],
            [['view_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => ViewPractice::class, 'targetAttribute' => ['view_practice_id' => 'id']],
            ['files', 'file', 'skipOnEmpty' => false, 'extensions' => 'gif, jpg, doc, docx', 'maxFiles' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doki' => 'Doki',
            'view_practice_id' => 'View Practice ID',
        ];
    }

 /**
     * Gets query for [[PracticeGroups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeGroups()
    {
        return $this->hasMany(PracticeGroup::class, ['documents_id' => 'id']);
    }

     /**
     * Gets query for [[ViewPractice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getViewPractice()
    {
        return $this->hasOne(ViewPractice::class, ['id' => 'view_practice_id']);
    }

    /**
     * @throws Exception
     */
    public function upload()
    {
        if ($this->validate()){
            $this->doki = '';

            $zip = new ZipArchive;
            $tempFiles = [];
            $fileName = Yii::$app->user->id . '_' . Yii::$app->security->generateRandomString(12) . time() . '.zip';
            if ($zip->open(Yii::getAlias('@app').'/web/uploads/'.$fileName, ZipArchive::CREATE) === TRUE)
            {

                foreach ($this->files as $file) {
                    $imageName = $file->baseName . '.' . $file->extension;
                    $fullImagePath = Yii::getAlias('@app').'/web/uploads/'.$imageName;
                    $file->saveAs($fullImagePath);
                    $zip->addFile($fullImagePath, basename($fullImagePath));
                    $tempFiles[] = $fullImagePath;
                }
            
                $this->doki .= '/uploads/'.$fileName;
            
                $zip->close();
            }

            foreach ($tempFiles as $file) {
                unlink($file);
            }
            return true;
        } else {
            return false;
        }
    }


    public static function getDocumentsList()
    {
        return static::find()->select('doki',)->indexBy('id')->column();
    }
}