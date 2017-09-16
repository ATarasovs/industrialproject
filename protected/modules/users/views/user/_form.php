<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form">

	<div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'username', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'username',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>

	<div class="row align-items-center">
	<div class="col-6">
		<?php echo $form->labelEx($model,'password', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'password'); ?>
		</div>
	</div>
        
        <div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'forename', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'forename',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'forename'); ?>
		</div>
	</div>
        
        <div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'surname', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'surname',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'surname'); ?>
		</div>
	</div>
        
        <div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'email', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'email',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
        
        <div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'position', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'position',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'position'); ?>
		</div>
	</div>
        
        <div class="row align-items-center">
		<div class="col-6">
		<?php echo $form->labelEx($model,'phone', array('class'=>'form-signin-heading')); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'form-control', 'size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div>
	</div>
	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<div class="row buttons">
	<div class="col-6">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class' => 'btn btn-lg btn-primary btn-block')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>
	</div>

</div><!-- form -->

</div>