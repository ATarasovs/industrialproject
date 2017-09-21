<?php 
    class UploadfileController extends CController
    {
        public function actionCreate()
        {
            $model=new Uploadfile;
            if(isset($_POST['Uploadfile']))
            {
                $model->attributes=$_POST['Uploadfile'];
                $model->file=CUploadedFile::getInstance($model,'file');
                if($model->save())
                {
                    $path=Yii::getPathOfAlias('webroot').'/uploads/testbook.xls';
                    $model->file->saveAs($path);
                    Yii::app()->user->setFlash('success', "Data uploaded to the server!");
                    // redirect to success page
                }
            }
            $this->render('create', array('model'=>$model));
        }
    }
?>