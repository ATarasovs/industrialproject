<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->userID,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->userID)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->userID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->userID; ?></h1>

<table id="users">
    <thead>
        
    </thead>
    <tbody>
        <tr>
            <th><?php echo User::model()->getAttributeLabel('userID') ?>:</th>
            <td><?php echo $model->userID; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('username') ?>:</th>
            <td><?php echo $model->username; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('forename') ?>:</th>
            <td><?php echo $model->forename; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('surname') ?>:</th>
            <td><?php echo $model->surname; ?></td>
        </tr>
        <tr>
            <th><?php echo User::model()->getAttributeLabel('email') ?>:</th>
            <td><?php echo $model->email; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('phone') ?>:</th>
            <td><?php echo $model->phone; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('position') ?>:</th>
            <td><?php echo $model->position; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('password') ?>:</th>
            <td><?php echo $model->password; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('salt') ?>:</th>
            <td><?php echo $model->salt; ?></td>
        </tr>
    </tbody>
</table>
