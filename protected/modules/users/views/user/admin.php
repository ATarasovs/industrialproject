
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.users.assets.js').'\users-manage-list.js'), CClientScript::POS_HEAD);

/* @var $this UserController */
/* @var $model User */
?>

<h1>Manage Users</h1>
    <br>
    <div class="form-group col-md-5">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
            <input id="filterByUserId" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by user ID">
        </div>
        <br/>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
            <input id="filterByUserName" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by user name">
        </div>
    </div>
    <div class="form-group col-md-6">
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
    
<div class="pagination">
    <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header' => '',
        'nextPageLabel' => 'Next',
        'prevPageLabel' => 'Prev',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => 'disabled',
        'htmlOptions' => array(
            'class' => '',
        )
    ))?>
</div>

<script>
    var usersManageListReqUrl = '<?php print Yii::app()->createUrl('users/user/admin') ?>';	
    var userViewReqUrl = '<?php print Yii::app()->createUrl('users/user/view') ?>';
    var userUpdateReqUrl = '<?php print Yii::app()->createUrl('users/user/update') ?>';
//    var userDeleteReqUrl = '<?php print Yii::app()->createUrl('users/user/delete') ?>';

</script>


