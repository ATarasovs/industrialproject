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
				'actions'=>array('index','view', 'TestCall', 'LoadLineChartData'),
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
			$url= Yii::app()->request->getParam('id');


            $this->render('admin',array(
					//'dashboards'=>$dashboards, //return array of sales data
					'URL'=>$url
            ));
	}


	/**
	*  Retrieves previous week from given date and parses
	*	into a 2d array for loading into line chart
	*/
	public function actionTestCall(){

		$nWeeks = $_POST['ajaxData'];

		$weeklydata = $this->loadSumData($nWeeks);

		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($weeklydata, JSON_FORCE_OBJECT);

	}

	public function actionLoadLineChartData()
	{
		$nWeeks = $_POST['Period'];
		$dateFrom = $_POST['DateFrom'];
		$dateTo = $_POST['DateTo'];
		$timeFrom = $_POST['TimeFrom'];
		$timeTo = $_POST['TimeTo'];
		$weekdayFrom = $_POST['WeekdayFrom'];
		$weekdayTo = $_POST['WeekdayTo'];

		if($dateTo == "" || $dateFrom == ""){
			//LOAD DATA FROM CURRENT WEEK
			return "";
		}

		$lineData = $this->loadLineChartData($nWeeks, $dateFrom, $dateTo, $timeFrom, $timeTo, $weekdayFrom, $weekdayTo);

		//// output some JSON instead of the usual text/html
		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($lineData, JSON_FORCE_OBJECT);

	}

	public function loadSumData($nWeeks)
	{
		$arrOutlets = Dashboard::model()->outletsArray();

		$date = date('Y-m-d H:i:s',  strtotime('-'.$nWeeks.'week'));

		$criteria = new CDbCriteria();
		$criteria->addCondition('Date_Time > "'.$date.'" ');

		$search_results = Dashboard::model()->findAll($criteria);

		$arrMonthlySumData =[]; 

		$arrOutlets = Dashboard::model()->outletsArray();
		
				foreach($arrOutlets as $outlet){

					$total = 0;
		
					foreach($search_results as $rec){

						if($rec->Outlet_Name == $outlet)
						{
							$total = $total + $rec->Total_Amount;
						}
					}
					//Every record searched for outlet
					$arrMonthlySumData[] = $total;
		
				}

		return $arrMonthlySumData;

	}

	public function loadLineChartData($nDays, $dateFrom, $dateTo, $timefrom, $timeto, $weekdayfrom, $weekdayto)
	{
		if($dateFrom == ""){
			
		} else {
			
			$d1 = new DateTime( $dateFrom );
			$d2 = new DateTime( $dateTo );
	
			$diff=date_diff($d1, $d2);
			$nDays = ($diff->days);
	
			$arrOutlets = Dashboard::model()->outletsArray();
			
			$date = date('Y-m-d H:i:s',  strtotime('-'.$nDays.'days'));
	
			$date = $dateTo;
		}

		//GET WEEKDAYS FROM TWO DAYS


		
		$dates = [];
		
		for($i=0; $i<$nDays; $i++)
		{
			
			$dayDate = date('Y-m-d', strtotime('-'.$i.' day', strtotime($date)));
			$dates[] = $dayDate;
			
		}
		
		$dates[] = date('Y-m-d', strtotime($dateFrom));

		$dateto = $dates[0];
		$length = count($dates); 
		$datefrom = $dates[$length-1];


		$criteria = new CDbCriteria();

		if ($datefrom != "" && $dateto !="") {
			if ($datefrom != $dateto){
				if($datefrom < $dateto){
					$criteria->addCondition("DATE(Date_Time) >= '$datefrom' and DATE(Date_Time) <= '$dateto'");
				} elseif ($datefrom > $dateto){
					$criteria->addCondition("DATE(Date_Time) >= '$dateto' and DATE(Date_Time) <= '$datefrom'");
				}
			} elseif ($datefrom = $dateto) {
					$criteria->addCondition("DATE(Date_Time) = '$datefrom'");
			}
		  }  else{
			  if ($datefrom != ""){
				  $criteria->addCondition("DATE(Date_Time) = '$datefrom'");
			  } elseif ( $dateto != ""){
				 $criteria->addCondition("DATE(Date_Time) = '$dateto'");
			  }            
		 }

		if ($timefrom != "" && $timeto !="") {
			if($timefrom != $timeto){
				if($timefrom < $timeto){
					$criteria->addCondition("TIME(Date_Time) >= '$timefrom' and TIME(Date_Time) <= '$timeto'");
				} elseif ($timefrom > $timeto){
					$criteria->addCondition("TIME(Date_Time) NOT BETWEEN  '$timeto' AND '$timefrom'");
				}
			} else {
				$criteria->addCondition("TIME(Date_Time) = '$timefrom'");
			}
		} elseif ($timefrom != ""){
			 $criteria->addCondition("TIME(Date_Time) = '$timefrom'");
		} elseif ($timeto != ""){
			 $criteria->addCondition("TIME(Date_Time) = '$timeto'");
		}

		if ($weekdayfrom != "" && $weekdayto !="") {
			
			if ($weekdayfrom != $weekdayto){
				if ($weekdayfrom < $weekdayto){
				$criteria->addCondition("WEEKDAY(Date_Time) >= '$weekdayfrom' and WEEKDAY(Date_Time) <= '$weekdayto'");
				} elseif ($weekdayfrom > $weekdayto){
					$criteria->addCondition("WEEKDAY(Date_Time) NOT BETWEEN  '$weekdayto' AND '$weekdayfrom'");
				}
			} else {
				$criteria->addCondition("WEEKDAY(Date_Time) = '$weekdayfrom'");
			}
		 }  elseif ($weekdayfrom != ""){
			 $criteria->addCondition("WEEKDAY(Date_Time) = '$weekdayfrom'");
		 } elseif ($weekdayto != ""){
			 $criteria->addCondition("WEEKDAY(Date_Time) = '$weekdayto'");
		 }


		 if($weekdayfrom != "" && $weekdayto != "")
		 {

			 $weekdays = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
			 $intWeekdays = [0,1,2,3,4,5,6];
	 
	 
			 $dates2 = $dates;
			 $dates3 = [];			
	 
			 //CONVERT DATES INTO WEEKDAYS
			 foreach($dates2 as $date)
			 {
				 $timestamp = strtotime($date);
				 $dateres = idate('w', $timestamp);	//Get day of week as int
				 $dates3[] = ($dateres-1);
			 }
	 
			 $dates3 = array_reverse($dates3); //DATES 3 IS AN ARRAY FO EVERY DATE AS A WEEKDAY

			 $sd = intval($weekdayfrom);
			 $ed = intval($weekdayto);
			 $days = [];
	 
			 //loop through dates and find window of dates

			 if($sd == $ed)
			 {
				 $days[] = $sd;

			 } else
			 {

				 $days[] = $sd;
				 do{
					 $sd++;
					 if($sd > 6){ //keep wihtin bounds of weekday array
						 $sd = 0;
					 } 
					 if($sd == $ed){
						 $days[] = $ed;		//COMPLETE RE-THINK THIS CODE
					 } else {
						 $days[] = $sd;
					 }
					 
				 } while ($sd != $ed);
			 }
			 
			 $dates = array_reverse($dates);
			 //return [$days, $dates3, $dates];
	 
			 //return [$days,$dates3];
	 
			 //Convert LOOP THROUGH DATES 3 (EVERY DATE AS A DAY) AND IF IT DOESNT MATCH ANY OF DAYS, THEN REMOVE 
			 $delArr = [];
	 
			 for($i =0; $i < count($dates3); $i++)
			 {
				 $matchFlag = false;
				 for($o = 0; $o < count($days); $o++)
				 {
					 if($dates3[$i] == $days[$o])
					 {
						 $matchFlag = true;
					 }
				 }
	 
				 if($matchFlag == false){
					 unset($dates[$i]);
				 }
				 
			 }
	 
			 $dates = array_values($dates);
			} else {
				
				$dates = array_reverse($dates);
		}

		//return $dates;


		$search_results = Dashboard::model()->findAll($criteria);
		
		$lineChartDataArr =[];

		$lineChartDataArr[] = $dates;

		foreach($arrOutlets as $outlet)
		{
			$outletTotals = [];
			foreach($dates as $cdate)
			{
				$dayTotal = 0;
				
				
				foreach($search_results as $rec)
				{
					
					if(($rec->Outlet_Name == $outlet))//&&($rec->Date_Time == $date)) //
					{
						

						$d1 = date('Y-m-d', strtotime($cdate));
						$d2 = date('Y-m-d', strtotime($rec->Date_Time));

						if($d1 == $d2){

							$dayTotal = $dayTotal + $rec->Total_Amount;
						}

						
						
						//if(($d2 > $d1) && ($d2 < $d3) )
						//{
						//	$dayTotal = $dayTotal + $rec->Total_Amount;
							//return $datefrom;

						//}
					}
				}
				$outletTotals[] = $dayTotal;
				//unset($outletTotals);
			}
			$lineChartDataArr[] = $outletTotals;
		}

		return $lineChartDataArr;

	}

	/**
	*  Retrieves previous week from given date and parses
	*	into a 2d array for loading into line chart
	*/
	function actionGetLastNDates($nDays)
	{
		//If Date is used in table
		//$date = date("Y-m-d");

		if($nDays == null){
			return;
		}

		//$date = new CDbExpression("NOW()");


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
