<?php
    Yii::import('application.vendor.*');
    require_once "PHPExcel/PHPExcel.php";
    require_once "PHPExcel/PHPExcel/Autoloader.php";
    Yii::registerAutoloader(array('PHPExcel_Autoloader','Load'), true);


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
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('upload', 'admin', 'view', 'savetribe'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array('@'),
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
            /*
            $criteria = new CDbCriteria();
            
            $datefrom = Yii::app()->request->getParam('datefrom');
            $dateto = Yii::app()->request->getParam('dateto');
            $timefrom = Yii::app()->request->getParam('timefrom');
            $timeto = Yii::app()->request->getParam('timeto');
            $weekdayfrom = Yii::app()->request->getParam('weekdayfrom');
            $weekdayto = Yii::app()->request->getParam('weekdayto');
            $year = Yii::app()->request->getParam('year');
            $month = Yii::app()->request->getParam('month');
            $outletname0 = Yii::app()->request->getParam('outlet0');
            $outletname1 = Yii::app()->request->getParam('outlet1');
            $outletname2 = Yii::app()->request->getParam('outlet2');
            $outletname3 = Yii::app()->request->getParam('outlet3');
            $outletname4 = Yii::app()->request->getParam('outlet4');
            $outletname5 = Yii::app()->request->getParam('outlet5');
            $outletname6 = Yii::app()->request->getParam('outlet6');
            $outletname7 = Yii::app()->request->getParam('outlet7');
            $outletname8 = Yii::app()->request->getParam('outlet8');
            $outletname9 = Yii::app()->request->getParam('outlet9');
            $outletname10 = Yii::app()->request->getParam('outlet10');
            $outletname11 = Yii::app()->request->getParam('outlet11');
            $outletname12 = Yii::app()->request->getParam('outlet12');
            $outletname13 = Yii::app()->request->getParam('outlet13');
            $retailername = Yii::app()->request->getParam('retailer');
            $userid0 = Yii::app()->request->getParam('userid0');
            $userid1 = Yii::app()->request->getParam('userid1');
            $userid2 = Yii::app()->request->getParam('userid2');
            $userid3 = Yii::app()->request->getParam('userid3');
            $userid4 = Yii::app()->request->getParam('userid4');
            $transactiontype = Yii::app()->request->getParam('transactiontype');
            $totalamountfrom = Yii::app()->request->getParam('totalamountfrom');
            $totalamountto = Yii::app()->request->getParam('totalamountto');


            //Date Filtering
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

            //Time From Filtering
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

             //Year Filtering
             if($year !=""){
             	$criteria->addCondition("Year(Date_Time) = '$year'");
             }

             //Month Filtering
             if($month != ""){
             	 $criteria->addCondition("Month(Date_Time) = '$month'");
             }
             
             if($outletname0 != "") {
                $criteria->addInCondition('Outlet_Name',array($outletname0, $outletname1, $outletname2, $outletname3, $outletname4, $outletname5, $outletname6, $outletname7, $outletname8, $outletname9, $outletname10, $outletname11, $outletname12, $outletname13));
             }
            
            if ($retailername != "") {
                $criteria->addCondition("Retailer_Name = '$retailername'");
            }
            
            if($userid0 != "") {
                $criteria->addInCondition('New_user_id',array($userid0, $userid1, $userid2, $userid3, $userid4));
            }
            
            if ($transactiontype != "") {
                $criteria->addCondition("Transaction_Type = '$transactiontype'");
            }
            
            if ($transactiontype != "") {
                $criteria->addCondition("Transaction_Type = '$transactiontype'");
            }
            
            if ($totalamountfrom != "" && $totalamountto != "") {
                $criteria->addCondition("Total_Amount >= '$totalamountfrom' and Total_Amount <= '$totalamountto'");
            }
            
            if ($totalamountfrom != "") {
                $criteria->addCondition("Total_Amount >= '$totalamountfrom'");
            }
            
            if ($totalamountto != "") {
                $criteria->addCondition("Total_Amount <= '$totalamountto'");
            }
            
            
            
            $criteria->order = 'Date_Time DESC';*/

            $criteria = $this->getCriteria();
            $userid0 = Yii::app()->request->getParam('userid0');
            if($userid0 != "")
            {
                $graphData = Sale::model()->findAll($criteria);
            }
            
            
            $count=Sale::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $sales = Sale::model()->findAll($criteria);
            
            $outletsArray = CHtml::listData(Outlet::model()->findAll(), 'outletName', 'outletName');
            $transactionsArray = CHtml::listData(Payment::model()->findAll(), 'transactionType', 'transactionType');
            
            $tribecriteria = new CDbCriteria();
            $currenUserID = Yii::app()->user->getId();
            $tribecriteria->addCondition("userID = '$currenUserID'");
            $tribes = Tribe::model()->findAll($tribecriteria);

            //GRAPH GENERATION - only if DUSA UID IS NOT NULL
            //get list of outlets, push to array
            $outletsArr = [];
            $totalsArr = [];
            $userTotals = [];
            $outletsA= [];
            $users=[];
            $userSpendTotals = [];
            if($userid0 != "")
            {
                $arrAllOutlets = [$outletname0, $outletname1, $outletname2, $outletname3, $outletname4, $outletname5, $outletname6, $outletname7, $outletname8, $outletname9, $outletname10, $outletname11, $outletname12, $outletname13];
                $outletsA = [];

                foreach($arrAllOutlets as $outlet)
                {
                   $key = array_search($outlet, $outletsArray);
                   if($key != null)
                   {
                       $outletsA[] = $key;
                   }
                }
                if(count($outletsA) ==0)
                {
                    $outletsA = array_values($outletsArray);
                }

                              
                //Count outlet totals for each user
                $users = [];
                $_users = [$userid0, $userid1, $userid2, $userid3, $userid4];
                foreach($_users as $user)
                {
                    if(strlen($user) == 9){ //count 9 = valid id
                        $users[] = $user;
                    } 
                }

                $userTotals = [];
                $userSpendTotals = [];
                foreach($users as $user)
                {
                    
                    $totalsArr = array_fill(0,count($outletsA), 0); //populate array of same length as outlets with 0s
                    $spendtotalsArr = array_fill(0,count($outletsA), 0); //populate array of same length as outlets with 0s
                    foreach($graphData as $rec) //loop through search results
                    {
                        if($rec->New_user_id == $user)
                        {
                            
                            //$key = array_search($rec->Outlet_Name, $outletsA);
                            for($i=0; $i<count($outletsA); $i++)
                            {
                                if($rec->Outlet_Name == $outletsA[$i]){
                                    //Increase tally for transaction spread
                                    $val = $totalsArr[$i];
                                    $totalsArr[$i] = ($val+1);

                                    //Increase total spend for outlet
                                    $val = $spendtotalsArr[$i];
                                    $spendtotalsArr[$i] = ($val + $rec->Total_Amount);


                                }
                            } 

                        }
        
                    }
                    $userTotals[] = $totalsArr; //add users total to total array
                    $userSpendTotals[] = $spendtotalsArr;


                }

            }

            $this->render('admin',array(
                    'sales'=>$sales,
                    'pages' => $pages,
                    'outletsArray' => $outletsArray,
                    'transactionsArray' => $transactionsArray,
                    'tribes' => $tribes,
                    'outletsArr' => $outletsArr,
                    'userTotals' => $userTotals,
                    'userSales' => $userSpendTotals,
                    'users' => $users, 
                    'outletsA' => $outletsA,

            ));
	}
        
        public function getCriteria() {
            $criteria = new CDbCriteria();
            
            $datefrom = Yii::app()->request->getParam('datefrom');
            $dateto = Yii::app()->request->getParam('dateto');
            $timefrom = Yii::app()->request->getParam('timefrom');
            $timeto = Yii::app()->request->getParam('timeto');
            $weekdayfrom = Yii::app()->request->getParam('weekdayfrom');
            $weekdayto = Yii::app()->request->getParam('weekdayto');
            $year = Yii::app()->request->getParam('year');
            $month = Yii::app()->request->getParam('month');
            $outletname0 = Yii::app()->request->getParam('outlet0');
            $outletname1 = Yii::app()->request->getParam('outlet1');
            $outletname2 = Yii::app()->request->getParam('outlet2');
            $outletname3 = Yii::app()->request->getParam('outlet3');
            $outletname4 = Yii::app()->request->getParam('outlet4');
            $outletname5 = Yii::app()->request->getParam('outlet5');
            $outletname6 = Yii::app()->request->getParam('outlet6');
            $outletname7 = Yii::app()->request->getParam('outlet7');
            $outletname8 = Yii::app()->request->getParam('outlet8');
            $outletname9 = Yii::app()->request->getParam('outlet9');
            $outletname10 = Yii::app()->request->getParam('outlet10');
            $outletname11 = Yii::app()->request->getParam('outlet11');
            $outletname12 = Yii::app()->request->getParam('outlet12');
            $outletname13 = Yii::app()->request->getParam('outlet13');
            $retailername = Yii::app()->request->getParam('retailer');
            $userid0 = Yii::app()->request->getParam('userid0');
            $userid1 = Yii::app()->request->getParam('userid1');
            $userid2 = Yii::app()->request->getParam('userid2');
            $userid3 = Yii::app()->request->getParam('userid3');
            $userid4 = Yii::app()->request->getParam('userid4');
            $transactiontype = Yii::app()->request->getParam('transactiontype');
            $totalamountfrom = Yii::app()->request->getParam('totalamountfrom');
            $totalamountto = Yii::app()->request->getParam('totalamountto');


            //Date Filtering
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

            //Time From Filtering
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

             //Year Filtering
             if($year !=""){
             	$criteria->addCondition("Year(Date_Time) = '$year'");
             }

             //Month Filtering
             if($month != ""){
             	 $criteria->addCondition("Month(Date_Time) = '$month'");
             }
             
             if($outletname0 != "") {
                $criteria->addInCondition('Outlet_Name',array($outletname0, $outletname1, $outletname2, $outletname3, $outletname4, $outletname5, $outletname6, $outletname7, $outletname8, $outletname9, $outletname10, $outletname11, $outletname12, $outletname13));
             }
            
            if ($retailername != "") {
                $criteria->addCondition("Retailer_Name = '$retailername'");
            }
            
            if($userid0 != "") {
                $criteria->addInCondition('New_user_id',array($userid0, $userid1, $userid2, $userid3, $userid4));
            }
            
            if ($transactiontype != "") {
                $criteria->addCondition("Transaction_Type = '$transactiontype'");
            }
            
            if ($transactiontype != "") {
                $criteria->addCondition("Transaction_Type = '$transactiontype'");
            }
            
            if ($totalamountfrom != "" && $totalamountto != "") {
                $criteria->addCondition("Total_Amount >= '$totalamountfrom' and Total_Amount <= '$totalamountto'");
            }
            
            if ($totalamountfrom != "") {
                $criteria->addCondition("Total_Amount >= '$totalamountfrom'");
            }
            
            if ($totalamountto != "") {
                $criteria->addCondition("Total_Amount <= '$totalamountto'");
            }
            
            
            
            $criteria->order = 'Date_Time DESC';
            
            return $criteria;
        }
        
        public function actionUpload()
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
                    
                    $path=Yii::getPathOfAlias('webroot').'/uploads/testbook.xls';
                    $inputFile = $path;
                    try {
                        $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
                        $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
                        $objPhpExcel = $objReader->load($inputFile);

                    } 
                    catch (Exception $ex) {
                        die ("die");
                    }

                    $sheet = $objPhpExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColoumn = $sheet->getHighestColumn();

                    for($row = 1; $row <= $highestRow; $row++) {
                        $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColoumn.$row,NULL,TRUE,FALSE);
                        if($row == 1) {
                            continue;
                        }

                        $sales = new Sale();

                        $date = date("Y-m-d H:i:s", PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0]));

                        $sales->Date_Time = $date;
                        $sales->Retailer_Ref = $rowData[0][1];
                        $sales->Outlet_Ref = $rowData[0][2];
                        $sales->Retailer_Name = $rowData[0][3];
                        $sales->Outlet_Name = $rowData[0][4];
                        $sales->New_user_id = $rowData[0][5];
                        $sales->Transaction_Type = $rowData[0][6];
                        $sales->Cash_Spent = $rowData[0][7];
                        $sales->Discount_Amount = $rowData[0][8];
                        $sales->Total_Amount = $rowData[0][9];
                        $sales->save();
                    }
                    Yii::app()->user->setFlash('success', "Excel sheet was successfully uploaded!");
                    $this->redirect('index.php?r=sales/sale/admin');
                }
            }
            $this->render('upload', array('model'=>$model));
        }
        
        public function actionSavetribe() {
            
            $title = Yii::app()->request->getParam('title');
            $description = Yii::app()->request->getParam('description');
            $datefrom = Yii::app()->request->getParam('datefrom');
            $dateto = Yii::app()->request->getParam('dateto');
            $timefrom = Yii::app()->request->getParam('timefrom');
            $timeto = Yii::app()->request->getParam('timeto');
            $weekdayfrom = Yii::app()->request->getParam('weekdayfrom');
            $weekdayto = Yii::app()->request->getParam('weekdayto');
            $year = Yii::app()->request->getParam('year');
            $month = Yii::app()->request->getParam('month');
            $outletname = Yii::app()->request->getParam('outlet');
            $retailername = Yii::app()->request->getParam('retailer');
            $newuserid = Yii::app()->request->getParam('newuserid');
            $transactiontype = Yii::app()->request->getParam('transactiontype');
            $totalamountfrom = Yii::app()->request->getParam('totalamountfrom');
            $totalamountto = Yii::app()->request->getParam('totalamountto');
            
            $tribes = new Tribe();
            
            $tribes->title = $title;
            $tribes->description = $description;
            $tribes->dateFrom = $datefrom;
            $tribes->dateTo = $dateto;
            $tribes->timeFrom = $timefrom;
            $tribes->timeTo = $timeto;
            $tribes->weekdayFrom = $weekdayfrom;
            $tribes->weekdayTo = $weekdayto;
            $tribes->year = $year;
            $tribes->month = $month;
            $tribes->totalAmountFrom = $totalamountfrom;
            $tribes->totalAmountTo = $totalamountto;
            $tribes->retailer = $retailername;
            $tribes->outletName = $outletname;
            $tribes->transactionType = $transactiontype;
            $tribes->new_user_ID = $newuserid;
            $tribes->userID = Yii::app()->user->getId();
            
            
            
            if($tribes->save()) {
                $tribeIDs = array();
                
                $sales = Sale::model()->findAll($this->getCriteria());
                
                foreach($sales as $sale) {
                    $tribeIDs[] = $sale->New_user_id;
                }
                $tribeUniqueIDs = array_unique($tribeIDs);
                
                $currenUserID = Yii::app()->user->getId();
                $tribeIDcriteria = new CDbCriteria();
                $tribeIDcriteria->addCondition("userID = '$currenUserID'");
                $tribeIDcriteria->order = 'filterID DESC';
                $filterID = Tribe::model()->find($tribeIDcriteria);
                
                /*
                //Get filterID
                $filterID = 0;
                for ($i=0; $i<count($tribeIDSearch); $i++) {
                    if ($filterID <= $tribeIDSearch->filterID) {
                        $filterID = $tribeIDSearch->filterID;
                    }
                }
                */
                
                //Save tribe members
                foreach($tribeUniqueIDs as $ID) {
                    $customer = new Customer();
                    $customer->filterID = $filterID->filterID;
                    $customer->customerID = $ID;
                    
                    if (!$customer->save()) {
                        Yii::app()->user->setFlash('errorTribeSave', "There appeared an error during saving the tribe!");
                        $this->redirect('index.php?r=sales/sale/admin');
                    }
                }
                
		Yii::app()->user->setFlash('successTribeSave', "The tribe was save successfully! You should see the button of this tribe");
                $this->redirect('index.php?r=sales/sale/admin');
            }
            else {
                Yii::app()->user->setFlash('errorTribeSave', "There appeared an error during saving the tribe!");
                $this->redirect('index.php?r=sales/sale/admin');
            }
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
