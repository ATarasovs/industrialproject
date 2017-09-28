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

	<div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'username', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'username',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>
        
        <div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'forename', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'forename',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'forename'); ?>
		</div>
	</div>
        
        <div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'surname', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'surname',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'surname'); ?>
		</div>
	</div>
        
        <div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'email', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'email',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
        
        <div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'position', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'position',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'position'); ?>
		</div>
	</div>
        
        <div class="">
		<div class="col-6">
                    <span class="left"><?php echo $form->label($model,'phone', array('class'=>'form-signin-heading')); ?></span>
		<?php echo $form->textField($model,'phone',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'phone'); ?>
		</div>
	</div>
           <br/>
	<div class="">
            <div class="col-6">
                <button class = "btn btn-lg btn-primary btn-block" id ="backBtn">Back</button>
            </div>

<?php $this->endWidget(); ?>
	</div>

<script>
    var usersListReqUrl = '<?php print Yii::app()->createUrl('users/user/admin') ?>';	
    
    $(document).ready(function() {
        initButtons();
    });
    
    function initButtons() {
        $( "#backBtn" ).click(function() {
            location.href = usersListReqUrl;
        });
     } 
</script>
