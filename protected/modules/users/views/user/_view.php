<?php $form=$this->beginWidget('CActiveForm', array(
	
)); ?>



<div class="form">
    <div class="">
            <div class="col-6">
                <span class="left"><?php echo $form->label($model,'username', array('class'=>'form-signin-heading')); ?></span>
                <?php echo $form->textField($model,'username',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'forename', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'forename',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'surname', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'surname',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'email', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'email',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'position', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'position',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'phone', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'phone',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
        </div>
    </div>
    <br/>
    <?php $this->endWidget(); ?>
</div>
<div class="col-6">
    <button class = "btn btn-lg btn-primary btn-block" id ="backBtn">Back</button>
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
