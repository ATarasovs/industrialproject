<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->redirect('index.php?r=dashboards/dashboard/admin');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	* 	Function which responds to test ajax request from index.php
	*/
	public function actionAjaxProcess(){

		$a = $_POST['ajaxData'];
		//process $a and get output $b

		//Array of Sales Data from 14th-20th
		$myArr = array(
			0 => array( //Prem
				31,	20,	10,	15,	98,	7,	80
			),
			1 => array( //Ninewells Shop
				15,	53,	19,	32,	28,	13,	80
			),
			2 => array( //Mono
				10,	10,	22,	30,	6,	300,	450
			),
			3 => array( //Library
				19,	17.50, 14,	14,	50,	2,	80
			),
			4 => array( //Liar Bar
				10,	20,	88,	0,	64,	100,	490
			),
			5 => array( //Level 2 Reception
				10,	20,	0,	0,	50,	170,	80
			),
			6 => array( //College Shop
				10,	20,	102, 40, 288, 0, 80
			),
			7 => array( //Dusa Marketplace
				10,	0,	126,	40,	0,	0,	80
			),
			8 => array( //DJCAD Canteen
				10,	0,	0,	40,	50,	70,	80
			),
			9 => array( // Food on Four
				10,	0,	0,	40,	50,	15,	80
			),
		);

		// output some JSON instead of the usual text/html
		header('Content-Type: application/json; charset="UTF-8"');
		echo CJSON::encode($myArr, JSON_FORCE_OBJECT);
	}
}