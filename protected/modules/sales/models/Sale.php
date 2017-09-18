<?php

/**
 * This is the model class for table "sale".
 *
 * The followings are the available columns in table 'sale':
 * @property integer $saleID
 * @property string $Date_Time
 * @property integer $Retailer_Ref
 * @property integer $Outlet_Ref
 * @property string $Retailer_Name
 * @property string $Outlet_Name
 * @property string $New_User_ID
 * @property string $Transaction_Type
 * @property string $Cash_Spent
 * @property string $Discount_Amount
 * @property string $Total_Amount
 */
class Sale extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Date_Time, Retailer_Ref, Outlet_Ref, Retailer_Name, Outlet_Name, New_User_ID, Transaction_Type, Cash_Spent, Discount_Amount, Total_Amount', 'required'),
			array('Retailer_Ref, Outlet_Ref', 'numerical', 'integerOnly'=>true),
			array('Retailer_Name, Outlet_Name', 'length', 'max'=>45),
			array('New_User_ID', 'length', 'max'=>9),
			array('Transaction_Type', 'length', 'max'=>25),
			array('Cash_Spent, Discount_Amount, Total_Amount', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('saleID, Date_Time, Retailer_Ref, Outlet_Ref, Retailer_Name, Outlet_Name, New_User_ID, Transaction_Type, Cash_Spent, Discount_Amount, Total_Amount', 'safe', 'on'=>'search'),
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
			'saleID' => 'Sale',
			'Date_Time' => 'Date Time',
			'Retailer_Ref' => 'Retailer Ref',
			'Outlet_Ref' => 'Outlet Ref',
			'Retailer_Name' => 'Retailer Name',
			'Outlet_Name' => 'Outlet Name',
			'New_User_ID' => 'New User',
			'Transaction_Type' => 'Transaction Type',
			'Cash_Spent' => 'Cash Spent',
			'Discount_Amount' => 'Discount Amount',
			'Total_Amount' => 'Total Amount',
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

		$criteria->compare('saleID',$this->saleID);
		$criteria->compare('Date_Time',$this->Date_Time,true);
		$criteria->compare('Retailer_Ref',$this->Retailer_Ref);
		$criteria->compare('Outlet_Ref',$this->Outlet_Ref);
		$criteria->compare('Retailer_Name',$this->Retailer_Name,true);
		$criteria->compare('Outlet_Name',$this->Outlet_Name,true);
		$criteria->compare('New_User_ID',$this->New_User_ID,true);
		$criteria->compare('Transaction_Type',$this->Transaction_Type,true);
		$criteria->compare('Cash_Spent',$this->Cash_Spent,true);
		$criteria->compare('Discount_Amount',$this->Discount_Amount,true);
		$criteria->compare('Total_Amount',$this->Total_Amount,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sale the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
