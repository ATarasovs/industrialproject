<?php
/* @var $this SalesController */
/* @var $model Sales */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'saleID'); ?>
		<?php echo $form->textField($model,'saleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Date_Time'); ?>
		<?php echo $form->textField($model,'Date_Time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Retailer_Ref'); ?>
		<?php echo $form->textField($model,'Retailer_Ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Outlet_Ref'); ?>
		<?php echo $form->textField($model,'Outlet_Ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Retailer_Name'); ?>
		<?php echo $form->textField($model,'Retailer_Name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Outlet_Name'); ?>
		<?php echo $form->textField($model,'Outlet_Name',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'New_User_ID'); ?>
		<?php echo $form->textField($model,'New_User_ID',array('size'=>9,'maxlength'=>9)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Transaction_Type'); ?>
		<?php echo $form->textField($model,'Transaction_Type',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Cash_Spent'); ?>
		<?php echo $form->textField($model,'Cash_Spent',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Discount_Amount'); ?>
		<?php echo $form->textField($model,'Discount_Amount',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Total_Amount'); ?>
		<?php echo $form->textField($model,'Total_Amount',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->