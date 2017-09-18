<?php
/* @var $this SalesController */
/* @var $model Sales */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sales-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Date_Time'); ?>
		<?php echo $form->textField($model,'Date_Time'); ?>
		<?php echo $form->error($model,'Date_Time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Retailer_Ref'); ?>
		<?php echo $form->textField($model,'Retailer_Ref'); ?>
		<?php echo $form->error($model,'Retailer_Ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Outlet_Ref'); ?>
		<?php echo $form->textField($model,'Outlet_Ref'); ?>
		<?php echo $form->error($model,'Outlet_Ref'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Retailer_Name'); ?>
		<?php echo $form->textField($model,'Retailer_Name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Retailer_Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Outlet_Name'); ?>
		<?php echo $form->textField($model,'Outlet_Name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Outlet_Name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'New_User_ID'); ?>
		<?php echo $form->textField($model,'New_User_ID',array('size'=>9,'maxlength'=>9)); ?>
		<?php echo $form->error($model,'New_User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Transaction_Type'); ?>
		<?php echo $form->textField($model,'Transaction_Type',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'Transaction_Type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Cash_Spent'); ?>
		<?php echo $form->textField($model,'Cash_Spent',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'Cash_Spent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Discount_Amount'); ?>
		<?php echo $form->textField($model,'Discount_Amount',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'Discount_Amount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Total_Amount'); ?>
		<?php echo $form->textField($model,'Total_Amount',array('size'=>5,'maxlength'=>5)); ?>
		<?php echo $form->error($model,'Total_Amount'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->