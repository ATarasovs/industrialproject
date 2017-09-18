
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/pagination.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.users.assets.js').'\users-manage-list.js'), CClientScript::POS_HEAD);

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

//Yii::app()->clientScript->registerScript('search', "
//$('.search-button').click(function(){
//	$('.search-form').toggle();
//	return false;
//});
//$('.search-form form').submit(function(){
//	$('#user-grid').yiiGridView('update', {
//		data: $(this).serialize()
//	});
//	return false;
//});
//");
?>

<h1>Manage Users</h1>
    <br>
    <div class="form-inline">
    <label class="sr-only" for="inlineFormInput">Name</label>
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
        <input id="filterByUserId" type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Filter By UserID" onkeyup="filters()">
    </div>

    <label class="sr-only" for="inlineFormInputGroup">Username</label>
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
        <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
        <input id="filterByUserName" type="text" class="form-control" id="inlineFormInputGroup" placeholder="Username" onkeyup="filters()">
    </div>

    <button id="searchBtn" class="btn btn-primary">Search</button> &nbsp; 
    <button id="unsetFiltersBtn" class="btn btn-primary">Unset Filters</button>
    </div>
<table id="users" class="table">
    <thead class="thead-inverse">
        <th><?php echo User::model()->getAttributeLabel('userID') ?></th>
        <th><?php echo User::model()->getAttributeLabel('username') ?></th>
        <th><?php echo User::model()->getAttributeLabel('forename')?></th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($users as $user) { ?>
        <tr class="table-info">
            <td class="id"><?php echo $user->userID; ?></td>
            <td class="username"><?php echo $user->username; ?></td>
            <td class="forename"><?php echo $user->forename; ?> <?php echo $user->surname; ?></td>
            <td>
                    <button class="viewBtn"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
                    <button class="updateBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>
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


