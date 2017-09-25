<?php

/**
 * This is the model class for table "quickview".
 *
 * The followings are the available columns in table 'quickview':
 * @property integer $viewID
 * @property integer $userID
 * @property string $title
 * @property string $locations
 * @property integer $WeekdayFrom
 * @property integer $WeekdayTo
 * @property string $TimeFrom
 * @property string $TimeTo
 * @property string $DateFrom
 * @property string $DateTo
 * @property string $description
 *
 * The followings are the available model relations:
 * @property User $user
 */
class Quickview extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'quickview';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('userID, title, locations', 'required'),
			array('userID, WeekdayFrom, WeekdayTo', 'numerical', 'integerOnly'=>true),
			array('title, locations', 'length', 'max'=>45),
			array('description', 'length', 'max'=>50),
			array('viewID, userID, title, locations, WeekdayFrom, WeekdayTo, TimeFrom, TimeTo, DateFrom, DateTo, description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('viewID, userID, title, locations, WeekdayFrom, WeekdayTo, TimeFrom, TimeTo, DateFrom, DateTo, description', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'userID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'viewID' => 'View',
			'userID' => 'User',
			'title' => 'Title',
			'locations' => 'Locations',
			'WeekdayFrom' => 'Weekday From',
			'WeekdayTo' => 'Weekday To',
			'TimeFrom' => 'Time From',
			'TimeTo' => 'Time To',
			'DateFrom' => 'Date From',
			'DateTo' => 'Date To',
			'description' => 'Description',
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

		$criteria->compare('viewID',$this->viewID);
		$criteria->compare('userID',$this->userID);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('locations',$this->locations,true);
		$criteria->compare('WeekdayFrom',$this->WeekdayFrom);
		$criteria->compare('WeekdayTo',$this->WeekdayTo);
		$criteria->compare('TimeFrom',$this->TimeFrom,true);
		$criteria->compare('TimeTo',$this->TimeTo,true);
		$criteria->compare('DateFrom',$this->DateFrom,true);
		$criteria->compare('DateTo',$this->DateTo,true);
		$criteria->compare('description',$this->description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Quickview the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
