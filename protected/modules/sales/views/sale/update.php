<?php
/* @var $this SalesController */
/* @var $model Sales */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	$model->saleID=>array('view','id'=>$model->saleID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
	array('label'=>'Create Sale', 'url'=>array('create')),
	array('label'=>'View Sale', 'url'=>array('view', 'id'=>$model->saleID)),
	array('label'=>'Manage Sales', 'url'=>array('admin')),
);
?>

<h1>Update Sale <?php echo $model->saleID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>