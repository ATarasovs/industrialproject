<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage users'=>array('admin'),
	'Create',
);
?>

<h1>Create User</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>