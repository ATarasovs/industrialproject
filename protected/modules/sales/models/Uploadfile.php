<?php

class Uploadfile extends CActiveRecord
{
    public $file;
    // ... other attributes
    
    public function tableName()
	{
		return 'uploadfile';
	}
 
    public function rules()
    {
        return array(
            array('file', 'file', 'types'=>'xls, xlsx', 'safe' => false),
        );
    }
}
