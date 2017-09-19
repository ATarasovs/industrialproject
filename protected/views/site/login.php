<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>
<p>Please fill out the following form with your login credentials:</p>
<br><br>

<div class="container h-50">

  <div class="row h-50 justify-content-center align-items-center">
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'login-form',
		'enableClientValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>

</div>

<div class="container">

	<div class="container">
		<div class="form">
		<div class="row">
			<?php echo $form->labelEx( $model,'username', array('class'=>'form-signin-heading') ); ?>
			<?php echo $form->textField( $model,'username', array('class'=>'form-control ') ); ?>
			<?php echo $form->error($model,'username'); ?>
		</div>

		<div class="row">
		<?php echo $form->labelEx( $model,'password', array('class'=>'form-signin-heading') ); ?>
		<?php echo $form->passwordField( $model,'password', array('class'=>'form-control') ); ?>
			<?php echo $form->error($model,'password'); ?>
		</div>
		<br>
		<div class="row buttons">
			<?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-primary btn-block')); ?>
		</div>

		<br>
		<p class="note">Fields with <span class="required">*</span> are required.</p>
		</div><!-- form -->
	</div>

<?php $this->endWidget(); ?>
</div>







  

