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
				'actions'=>array('index','view', 'TestCall', 'LoadLineChartData', 'LoadAverageData', 'SaveQuickView', 'RetrieveQuickViews'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
	*	into a 2d array for loading into pie chart
	*/
	public function actionTestCall(){

		$nWeeks = $_POST['ajaxData'];

		$weeklydata = $this->loadSumData($nWeeks);

		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($weeklydata, JSON_FORCE_OBJECT);

	}

	//Add user created quickview to table 
	public function actionSaveQuickView()
	{
		$SelectedArr = $_POST['Selected']; //Array of which datasets are disbaled
		$UserID = Yii::app()->user->getId();		//Maybe just get from method
		$WeekdayFrom = $_POST['WeekdayFrom'];
		$WeekdayTo = $_POST['WeekdayTo'];
		$TimeFrom = $_POST['TimeFrom'];
		$TimeTo = $_POST['TimeTo'];
		$DateFrom = $_POST['DateFrom'];
		$DateTo = $_POST['DateTo'];
		$ViewName = $_POST['ViewName'];
		$Description = $_POST['ViewDescription'];

		$return = ["UID:".$UserID, $SelectedArr, $UserID, $DateFrom, $DateTo, $WeekdayFrom, $WeekdayTo, $TimeFrom, $TimeTo, $ViewName, $Description];

		//ADD TO DB RETURN BOOL

		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($return, JSON_FORCE_OBJECT);

	}

	//Get user created view for account
	public function actionRetrieveQuickViews()
	{
		$UID = Yii::app()->user->getId();

		$Views =[];

		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($Views, JSON_FORCE_OBJECT);

	}

	public function actionLoadAverageData()
	{
		$month = $_POST['Month'];
		$prevMonth = $_POST['PrevMonth'];

		if($month != null)
		{
			$CurrentMonthData = $this->loadAverageSpend($month);
			$PreviousMonthData = $this->loadAverageSpend($prevMonth);
		}

		$avgspendmonth[] = $CurrentMonthData;
		$avgspendmonth[] = $PreviousMonthData;
		
		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($avgspendmonth, JSON_FORCE_OBJECT);
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

		if($dateTo == "" && $dateFrom == ""){
			//LOAD DATA FROM CURRENT WEEK
			return "";
		}

		if(($dateFrom != "" && $dateTo== "") || ($dateFrom == $dateTo) )
		{
			$lineData = $this->loadDailyLineChartData($dateFrom, $timeTo, $timeFrom);
		} else
		{
			$lineData = $this->loadLineChartData($nWeeks, $dateFrom, $dateTo, $timeFrom, $timeTo, $weekdayFrom, $weekdayTo);
		}


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

	public function loadDailyLineChartData($date, $timefrom, $timeto)
	{

		$criteria = new CDbCriteria();

		if($date != "")
		{
			$criteria->addCondition("DATE(Date_Time) = '$date'");
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

		$search_results = Dashboard::model()->findAll($criteria);

		$arrOutlets = Dashboard::model()->outletsArray();
		
		$lineChartDataArr =[];

		$lineChartDataArr[] = $date;

		$date = date('Y-m-d H:i:s', strtotime($date));

		

		foreach($arrOutlets as $outlet) //for each outlet
		{
			$outletTotals = [];
			for($i=0; $i<24; $i++) //FOR EACH HOUR AS HOUR
			{
				$hourTotal = 0;
				
				foreach($search_results as $rec) //search all results
				{
					
					if($rec->Outlet_Name == $outlet) //if record matches current outlet being searched for
					{

						//Convert dates into a comparable formamt
						$d1 = date('Y-m-d H:i:s', strtotime($rec->Date_Time));

						$d2 = date("Y-m-d H:i:s", strtotime('+'.($i+1).' hours', strtotime($date))); 

						$d3 = date("Y-m-d H:i:s", strtotime('+'.$i.' hours', strtotime($date)));

						if(($d1 >= $d3) && $d1 <= $d2){

							$hourTotal = $hourTotal + $rec->Total_Amount; //if within date range, add total
						}

					}
				}
				$outletTotals[] = $hourTotal; //add hour total for outlet being searched
			}
			$lineChartDataArr[] = $outletTotals; //add hours for all outlets 
		}

		return $lineChartDataArr;

	}

	public function loadLineChartData($nDays, $dateFrom, $dateTo, $timefrom, $timeto, $weekdayfrom, $weekdayto)
	{
		if($dateFrom == ""){
			
		} else {
			
			$d1 = new DateTime( $dateFrom );
			$d2 = new DateTime( $dateTo );
	
			$diff=date_diff($d1, $d2); 		//Get difference between two days
			$nDays = ($diff->days);
	
			$arrOutlets = Dashboard::model()->outletsArray();
			
			$date = date('Y-m-d H:i:s',  strtotime('-'.$nDays.'days'));
	
			$date = $dateTo;
		}

		//GET WEEKDAYS FROM TWO DAYS
		$dates = [];
		
		for($i=0; $i<$nDays; $i++)
		{
			
			$dayDate = date('Y-m-d', strtotime('-'.$i.' day', strtotime($date)));  //
			$dates[] = $dayDate;
			
		}
		
		$dates[] = date('Y-m-d', strtotime($dateFrom));

		$dateto = $dates[0];			//Date from to first date in array
		$length = count($dates); 
		$datefrom = $dates[$length-1]; //Date to in from last in array

		//Apply criteria 
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

		//Weekday Filtering
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
				 $dw = ($dateres-1);
				 $dates3[] = ($dateres-1);
			 }
	 
			 $dates3 = array_reverse($dates3); //DATES 3 IS AN ARRAY OF EVERY DATE AS INT WEEKDAY

			 $sd = intval($weekdayfrom); //Start date int 
			 $ed = intval($weekdayto); //End date int
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
						$days[] = $ed;		
					} else {
						$days[] = $sd;
					}
					
				 } while ($sd != $ed);
			 }

			 $dates = array_reverse($dates);
	 
			 //Convert LOOP THROUGH EVERY DATE AS A DAY AND IF IT DOESNT MATCH SET 
			 //OF WEEKDAYS BETWEEN TO/FROM THEN DELETE
			 $delArr = [];
	 
			 for($i =0; $i < count($dates3); $i++)
			 {
				 $matchFlag = false;
				 for($o = 0; $o < count($days); $o++)
				 {
					if($dates3[$i] == -1)
					{
						if($days[$o] == 6)
						{
							$matchFlag=true;
						}
					}else if($dates3[$i] == $days[$o])
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



		$search_results = Dashboard::model()->findAll($criteria);
		
		$lineChartDataArr =[];

		$lineChartDataArr[] = $dates;

		foreach($arrOutlets as $outlet) //for every outlet
		{
			$outletTotals = [];
			foreach($dates as $cdate) //for eeach date supplied
			{
				$dayTotal = 0;
				
				
				foreach($search_results as $rec) //search all returned records
				{
					
					if(($rec->Outlet_Name == $outlet))//if outletname of record = current outlet being search for
					{
						

						$d1 = date('Y-m-d', strtotime($cdate));
						$d2 = date('Y-m-d', strtotime($rec->Date_Time)); //convert dates into comparable format

						if($d1 == $d2){

							$dayTotal = $dayTotal + $rec->Total_Amount;
						}

					}
				}
				$outletTotals[] = $dayTotal; //Add days tototal
				//unset($outletTotals);
			}
			$lineChartDataArr[] = $outletTotals;
		}

		return $lineChartDataArr;

	}

	//Load average speend bar chart data
	function loadAverageSpend($month)
	{
		$arrOutlets = Dashboard::model()->outletsArray();
		
		$criteria = new CDbCriteria();
		$criteria->addCondition('Date_Time > "'.$month.'" ');
		
		$search_results = Dashboard::model()->findAll($criteria);
		
		
		$arrOutlets = Dashboard::model()->outletsArray();

		unset($arrOutlets[0]); //remove dusa market place for now as it skews graph data 

		$arrOutlets = array_values($arrOutlets);
		
		$lineChartDataArr =[];
		$lineChartDataArr2 =[];
		$outletTotals =[];
		
		foreach($arrOutlets as $outlet)
		{
			$outletTotals = [];
			$dingTotal = []; //ding used to store number of records used to calculate average

			$hourTotal = 0;
			$dings = 0;
				
				foreach($search_results as $rec)
				{

					if($rec->Outlet_Name == $outlet)//&&($rec->Date_Time == $date)) //
					{

						$hourTotal = $hourTotal + $rec->Total_Amount;
						$dings ++;

					}
				}
				
				

			$lineChartDataArr[] = $hourTotal;
			$lineChartDataArr2[] = $dings;
		}

		//Calculate the averages for each total based on total/number of records which make up total
		$avg = 0;
		$averages = [];
		for($i = 0; $i<16; $i++)
		{
			$t1 = $lineChartDataArr[$i];
			$t2 = $lineChartDataArr2[$i];

			if($t1==0 || $t2 ==0)
			{
				$averages[] = 0;
			} else
			{
				$avg = $lineChartDataArr[$i]/$lineChartDataArr2[$i];
				$avg = round($avg,2); //Round to two places for £ output in chart
				$averages[] = $avg;
			}
			
		}

		return $averages;

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
