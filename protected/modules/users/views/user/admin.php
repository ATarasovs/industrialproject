
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<!--<script src="/protected/modules/users/assets/users-manage-list.js"></script>-->
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.users.assets.js').'\users-manage-list.js'), CClientScript::POS_HEAD);

//Yii::app()->clientScript->registerScriptFile(
//	Yii::app()->baseUrl.'/protected/modules/users/assets/users-manage-list.js'
//);

/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Users</h1>
<table id="users">
    <input id="filterByUserId" placeholder="filterByUserId" onkeyup="filters()"></input>
    <input id="filterByUserName" placeholder="filterByUserName" onkeyup="filters()" ></input>
    <button id="Search">Search</button>
    <thead>
        <th>User ID</th>
        <th>User name</th>
        <th>Password</th>
        <th>Salt</th>
        
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr>
            <td><?php echo $user->userID; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->password; ?></td>
            <td><?php echo $user->salt; ?></td>
        </tr>
       <?php } ?>

    </tbody>

    
</table>
<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'user-grid',
//	'dataProvider'=>$model->search(),
//	'filter'=>$model,
//	'columns'=>array(
//		'userID',
//		'username',
//		'password',
//		'salt',
//		array(
//			'class'=>'CButtonColumn',
//		),
//	),
//)); ?>

<script>


	
	
</script>


