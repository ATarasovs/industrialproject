<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage users'=>array('admin'),
	'Update',
);
?>

<h1>Update user: <?php echo $model->username; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>