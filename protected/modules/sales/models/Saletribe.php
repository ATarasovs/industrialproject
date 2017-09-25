<?php

/**
 * This is the model class for table "salefilters".
 *
 * The followings are the available columns in table 'salefilters':
 * @property integer $filterID
 * @property string $title
 * @property string $description
 * @property string $dateFrom
 * @property string $dateTo
 * @property string $timeFrom
 * @property string $timeTo
 * @property integer $weekdayFrom
 * @property integer $weekdayTo
 * @property string $year
 * @property integer $month
 * @property string $totalAmountFrom
 * @property string $totalAmountTo
 * @property string $retailer
 * @property string $outletName
 * @property string $transactionType
 * @property string $userID
 * @property string $username
 */
class Saletribe extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'salefilters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required'),
			array('weekdayFrom, weekdayTo, month', 'numerical', 'integerOnly'=>true),
			array('title, description, year, retailer, outletName, transactionType, userID, username', 'length', 'max'=>45),
			array('totalAmountFrom, totalAmountTo', 'length', 'max'=>12),
			array('dateFrom, dateTo, timeFrom, timeTo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('filterID, title, description, dateFrom, dateTo, timeFrom, timeTo, weekdayFrom, weekdayTo, year, month, totalAmountFrom, totalAmountTo, retailer, outletName, transactionType, userID, username', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'filterID' => 'Filter',
			'title' => 'Title',
			'description' => 'Description',
			'dateFrom' => 'Date From',
			'dateTo' => 'Date To',
			'timeFrom' => 'Time From',
			'timeTo' => 'Time To',
			'weekdayFrom' => 'Weekday From',
			'weekdayTo' => 'Weekday To',
			'year' => 'Year',
			'month' => 'Month',
			'totalAmountFrom' => 'Total Amount From',
			'totalAmountTo' => 'Total Amount To',
			'retailer' => 'Retailer',
			'outletName' => 'Outlet Name',
			'transactionType' => 'Transaction Type',
			'userID' => 'User',
			'username' => 'Username',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('filterID',$this->filterID);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('dateFrom',$this->dateFrom,true);
		$criteria->compare('dateTo',$this->dateTo,true);
		$criteria->compare('timeFrom',$this->timeFrom,true);
		$criteria->compare('timeTo',$this->timeTo,true);
		$criteria->compare('weekdayFrom',$this->weekdayFrom);
		$criteria->compare('weekdayTo',$this->weekdayTo);
		$criteria->compare('year',$this->year,true);
		$criteria->compare('month',$this->month);
		$criteria->compare('totalAmountFrom',$this->totalAmountFrom,true);
		$criteria->compare('totalAmountTo',$this->totalAmountTo,true);
		$criteria->compare('retailer',$this->retailer,true);
		$criteria->compare('outletName',$this->outletName,true);
		$criteria->compare('transactionType',$this->transactionType,true);
		$criteria->compare('userID',$this->userID,true);
		$criteria->compare('username',$this->username,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SaleTribe the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
