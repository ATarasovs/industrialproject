<?php
/* @var $this SalesController */
/* @var $model Sales */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->saleID,
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
	array('label'=>'Create Sale', 'url'=>array('create')),
	array('label'=>'Update Sale', 'url'=>array('update', 'id'=>$model->saleID)),
	array('label'=>'Delete Sale', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->saleID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Sales', 'url'=>array('admin')),
);
?>

<h1>View Sale #<?php echo $model->saleID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'saleID',
		'Date_Time',
		'Retailer_Ref',
		'Outlet_Ref',
		'Retailer_Name',
		'Outlet_Name',
		'New_User_ID',
		'Transaction_Type',
		'Cash_Spent',
		'Discount_Amount',
		'Total_Amount',
	),
)); ?>
