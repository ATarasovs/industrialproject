<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Manage users'=>array('admin'),
	'View',
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

<button id="backBtn" class="btn btn-primary"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> Back to list</button>

<script>
    var usersListReqUrl = '<?php print Yii::app()->createUrl('users/user/admin') ?>';	
    
    $(document).ready(function() {
        initButtons();
    });
    
    function initButtons() {
        $( "#backBtn" ).click(function() {
            location.href = usersListReqUrl;
        });
     }
    
    
</script>
