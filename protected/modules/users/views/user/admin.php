
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
    <button id="searchBtn">Search</button>
    <button id="unsetFiltersBtn">Unset filters</button>
    <thead>
        <th><?php echo User::model()->getAttributeLabel('userID') ?></th>
        <th><?php echo User::model()->getAttributeLabel('username') ?></th>
        <th><?php echo User::model()->getAttributeLabel('forename')?></th>
        <th>Actions</th>
        
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr class="user-row">
            <td class="id"><?php echo $user->userID; ?></td>
            <td class="username"><?php echo $user->username; ?></td>
            <td class="forename"><?php echo $user->forename; ?> <?php echo $user->surname; ?></td>
            <td>
                    <button class="viewBtn">View</button>
                    <button class="updateBtn">Update</button>
                <!--<button class="deleteBtn">Delete</button>-->
            </td>
        </tr>
       <?php } ?>

    </tbody>

    
</table>
<?php // $this->widget('zii.widgets.grid.CGridView', array(
//	'id'=>'user-grid',
//	'dataProvider'=>$user->search(),
//	'filter'=>$user,
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
    var usersManageListReqUrl = '<?php print Yii::app()->createUrl('users/user/admin') ?>';	
    var userViewReqUrl = '<?php print Yii::app()->createUrl('users/user/view') ?>';
    var userUpdateReqUrl = '<?php print Yii::app()->createUrl('users/user/update') ?>';
//    var userDeleteReqUrl = '<?php print Yii::app()->createUrl('users/user/delete') ?>';
</script>


