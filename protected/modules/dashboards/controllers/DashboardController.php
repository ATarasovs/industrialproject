<?php

class DashboardController extends Controller
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
		$model=new Dashboard;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Dashboard']))
		{
			$model->attributes=$_POST['Dashboard'];
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

		if(isset($_POST['Dashboard']))
		{
			$model->attributes=$_POST['Dashboard'];
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
		$dataProvider=new CActiveDataProvider('Dashboard');
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
            
            $saleid = Yii::app()->request->getParam('saleid');
//            $date = Yii::app()->request->getParam('date');
//            $time = Yii::app()->request->getParam('time');
            $outletname = Yii::app()->request->getParam('outlet');
            $retailername = Yii::app()->request->getParam('retailer');
            $userid = Yii::app()->request->getParam('userid');
            $transactiontype = Yii::app()->request->getParam('transactiontype');
            
            if ($saleid != "") {
               $criteria->addCondition("sales_id = $saleid"); 
            }
            
//            if ($date != "") {
//                $criteria->addCondition("date = '$date'");
//            }
//            
//            if ($time != "") {
//                $criteria->addCondition("time = '$time'");
//            }
            
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

            
            $count=Dashboard::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $dashboards = Dashboard::model()->findAll($criteria);

            $this->render('admin',array(
                    'dashboards'=>$dashboards,
                    'pages' => $pages
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Dashboard the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Dashboard::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Dashboard $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dashboard-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
