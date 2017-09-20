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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','upload','importexcel'),
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
            	if ($datefrom != $dateto){
                		$criteria->addCondition("DATE(Date_Time) >= '$datefrom' and DATE(Date_Time) <= '$dateto'");
            	} elseif ($datefrom = $dateto) {
            			$criteria->addCondition("DATE(Date_Time) = '$datefrom'");
            	}
            }
            
            if ($timefrom != "" && $timeto !="") {
            	if($timefrom < $timeto){
                	$criteria->addCondition("TIME(Date_Time) >= '$timefrom' and TIME(Date_Time) <= '$timeto'");
            	} elseif ($timefrom > $timeto){
            		$criteria->addCondition("TIME(Date_Time) NOT BETWEEN  '$timeto' AND '$timefrom'");
            	}
            }
            
            if ($weekdayfrom != "" && $weekdayto !="") {
                $criteria->addCondition("WEEKDAY(Date_Time) >= '$weekdayfrom' and WEEKDAY(Date_Time) <= '$weekdayto'");
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
        
        public function actionImportexcel() {
           
            $inputFile = 'uploads/testbook.xls';
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
                $sales->Date_Time = "13.10.2017  01:28:00";
                $exceldate = $rowData[0][0];
                $unixdate = ($exceldate - 25569) * 86400;
                
//                $date = $dateparts[2] + "-" + $dateparts[1] + "-" + $dateparts[0];
//                $datetime = $date + " " + $datetimeparts[1];
//                $newformat = date('Y-m-d H:i:s',$rowData[0][0]);
//                $oldformat = $rowData[0][0];
//                $sales->Date_Time = $newformat;
//                $sales->Retailer_Ref = $rowData[0][1];
//                $sales->Outlet_Ref = $rowData[0][2];
//                $sales->Retailer_Name = $rowData[0][3];
//                $sales->Outlet_Name = $rowData[0][4];
//                $sales->New_user_id = $rowData[0][5];
//                $sales->Transaction_Type = $rowData[0][6];
//                $sales->Cash_Spent = $rowData[0][7];
//                $sales->Discount_Amount = $rowData[0][8];
//                $sales->Total_Amount = $rowData[0][9];
//                $sales->save();
            }
            
            $criteria = new CDbCriteria();
            
            $criteria->order = 'Date_Time DESC';
            $count=Sale::model()->count($criteria);
            $pages=new CPagination($count);
            $pages->pageSize=10;
            $pages->applyLimit($criteria);
            $sales = Sale::model()->findAll($criteria);

            $this->render('admin',array(
                    'sales'=>$sales,
                    'pages' => $pages,
                    'newformat' => $unixdate,
//                    'oldformat' => $oldformat,
            ));
            
        }
        
//        public function actionUpload() {
//           
//            $objPHPExcel = new PHPExcel();
//            $objPHPExcel->setActiveSheetIndex(0)
//                        ->setCellValue('A1', 'Hello')
//                        ->setCellValue('B2', 'world!')
//                        ->setCellValue('C1', 'Hello')
//                        ->setCellValue('D2', 'world!');
//
//            $objPHPExcel->getActiveSheet()->setTitle('Simple');
//
//            $objPHPExcel->setActiveSheetIndex(0);
//
//            ob_end_clean();
//            ob_start();
//
//            header('Content-Type: application/vnd.ms-excel');
//            header('Content-Disposition: attachment;filename="test.xls"');
//            header('Cache-Control: max-age=0');
//            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
//            $objWriter->save('php://output');
//            
//            $this->render('upload',array(
//                
//            ));
//        }

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
