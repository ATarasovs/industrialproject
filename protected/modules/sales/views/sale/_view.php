<?php
/* @var $this SalesController */
/* @var $data Sales */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('saleID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->saleID), array('view', 'id'=>$data->saleID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Date_Time')); ?>:</b>
	<?php echo CHtml::encode($data->Date_Time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Retailer_Ref')); ?>:</b>
	<?php echo CHtml::encode($data->Retailer_Ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Outlet_Ref')); ?>:</b>
	<?php echo CHtml::encode($data->Outlet_Ref); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Retailer_Name')); ?>:</b>
	<?php echo CHtml::encode($data->Retailer_Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Outlet_Name')); ?>:</b>
	<?php echo CHtml::encode($data->Outlet_Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('New_User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->New_User_ID); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Transaction_Type')); ?>:</b>
	<?php echo CHtml::encode($data->Transaction_Type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cash_Spent')); ?>:</b>
	<?php echo CHtml::encode($data->Cash_Spent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Discount_Amount')); ?>:</b>
	<?php echo CHtml::encode($data->Discount_Amount); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Total_Amount')); ?>:</b>
	<?php echo CHtml::encode($data->Total_Amount); ?>
	<br />

	*/ ?>

</div>