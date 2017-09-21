<?php

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'Upload',
);
?>

<div class="container">
    <div class="row">
        
        <?php $form = ActiveForm::begin(); ?>
    </div>
</div>
    

<script>
    var salesListReqUrl = '<?php print Yii::app()->createUrl('sales/sale/admin') ?>';	
    var salesViewReqUrl = '<?php print Yii::app()->createUrl('sales/sale/view') ?>';
</script>
