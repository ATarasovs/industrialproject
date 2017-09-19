<?php

class SaleController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Sale;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sale']))
		{
			$model->attributes=$_POST['Sale'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->saleID));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Sale']))
		{
			$model->attributes=$_POST['Sale'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->saleID));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Sale');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            $criteria = new CDbCriteria();
            
            $datefrom = Yii::app()->request->getParam('datefrom');
            $dateto = Yii::app()->request->getParam('dateto');
            $timefrom = Yii::app()->request->getParam('timefrom');
            $timeto = Yii::app()->request->getParam('timeto');
            $weekdayfrom = Yii::app()->request->getParam('weekdayfrom');
            $weekdayto = Yii::app()->request->getParam('weekdayto');
            $outletname = Yii::app()->request->getParam('outlet');
            $retailername = Yii::app()->request->getParam('retailer');
            $userid = Yii::app()->request->getParam('userid');
            $transactiontype = Yii::app()->request->getParam('transactiontype');
            
            if ($datefrom != "" && $dateto !="") {
                $criteria->addCondition("DATE(Date_Time) >= '$datefrom' and DATE(Date_Time) <= '$dateto'");
            }
            
            if ($timefrom != "" && $timeto !="") {
                $criteria->addCondition("TIME(Date_Time) >= '$timefrom' and TIME(Date_Time) <= '$timeto'");
            }
            
            if ($weekdayfrom != "" && $weekdayto !="") {
                $criteria->addCondition("DAYOFWEEK(Date_Time) >= '$weekdayfrom' and DAYOFWEEK(Date_Time) <= '$weekdayto'");
            }
            
            if ($outletname != "") {
                $criteria->addCondition("Outlet_Name = '$outletname'");
            }
            
            if ($retailername != "") {
                $criteria->addCondition("Retailer_Name = '$retailername'");
            }
            
            if ($userid != "") {
                $criteria->addCondition("New_user_id = '$userid'");
            }
            
            if ($transactiontype != "") {
                $criteria->addCondition("Transaction_Type = '$transactiontype'");
            }
            
            $criteria->order = 'Date_Time DESC';
            $count=Sale::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $sales = Sale::model()->findAll($criteria);

            $this->render('admin',array(
                    'sales'=>$sales,
                    'pages' => $pages
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Sale the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Sale::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Sale $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='sale-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
