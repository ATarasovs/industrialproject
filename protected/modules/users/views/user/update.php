<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('admin'),
	$model->userID=>array('view','id'=>$model->userID),
	'Update',
);
?>

<h1>Update User <?php echo $model->userID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>