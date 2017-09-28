<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

<?php echo $form->errorSummary($model); ?>

<div class="form">
    <div class="">
            <div class="col-6">
                <span class="left"><?php echo $form->label($model,'sales_id', array('class'=>'form-signin-heading')); ?></span>
                <?php echo $form->textField($model,'sales_id',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
                <?php echo $form->error($model,'sales_id'); ?>
            </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Date_Time', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Date_Time',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Date_Time'); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Retailer_Ref', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Retailer_Ref',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Retailer_Ref'); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Outlet_Ref', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Outlet_Ref',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Outlet_Ref'); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Retailer_Name', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Retailer_Name',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Retailer_Name'); ?>
        </div>
    </div>

    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Outlet_Name', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Outlet_Name',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Outlet_Name'); ?>
        </div>
    </div>
    
    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'New_user_id', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'New_user_id',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'New_user_id'); ?>
        </div>
    </div>
    
    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Cash_Spent', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Cash_Spent',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Cash_Spent'); ?>
        </div>
    </div>
    
    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Discount_Amount', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Discount_Amount',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Discount_Amount'); ?>
        </div>
    </div>
    
    <div class="">
        <div class="col-6">
            <span class="left"><?php echo $form->label($model,'Total_Amount', array('class'=>'form-signin-heading')); ?></span>
            <?php echo $form->textField($model,'Total_Amount',array('class'=>'form-control', 'size'=>32,'maxlength'=>32, 'disabled'=>'disabled')); ?>
            <?php echo $form->error($model,'Total_Amount'); ?>
        </div>
    </div>
       <br/>
       <?php $this->endWidget(); ?>
</div>
<div class="">
    <div class="col-6">
        <button class = "btn btn-lg btn-primary btn-block" id ="backBtn">Back</button>
    </div>
</div>
<script>
    var salesListReqUrl = '<?php print Yii::app()->createUrl('sales/sale/admin') ?>';	
    
    $(document).ready(function() {
        initButtons();
    });
    
    function initButtons() {
        $( "#backBtn" ).click(function() {
            location.href = salesListReqUrl;
        });
     } 
</script>
