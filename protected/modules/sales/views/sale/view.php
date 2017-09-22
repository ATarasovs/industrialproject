<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Sales'=>array('admin'),
	$model->sales_id,
);
?>

<h1>View Sale #<?php echo $model->sales_id; ?></h1>

<table id="users">
    <thead>
        
    </thead>
    <tbody>
        <tr>
            <th><?php echo User::model()->getAttributeLabel('sales_id') ?>:</th>
            <td><?php echo $model->sales_id; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Date_Time') ?>:</th>
            <td><?php echo $model->Date_Time; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Retailer_Ref') ?>:</th>
            <td><?php echo $model->Retailer_Ref; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Outlet_Ref') ?>:</th>
            <td><?php echo $model->Outlet_Ref; ?></td>
        </tr>
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Retailer_Name') ?>:</th>
            <td><?php echo $model->Retailer_Name; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Outlet_Name') ?>:</th>
            <td><?php echo $model->Outlet_Name; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('New_user_id') ?>:</th>
            <td><?php echo $model->New_user_id; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Cash_Spent') ?>:</th>
            <td><?php echo $model->Cash_Spent; ?></td>
        </tr>
        
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Discount_Amount') ?>:</th>
            <td><?php echo $model->Discount_Amount; ?></td>
        </tr>
        <tr>
            <th><?php echo User::model()->getAttributeLabel('Total_Amount') ?>:</th>
            <td><?php echo $model->Total_Amount; ?></td>
        </tr>
    </tbody>
</table>

<button id="backBtn">Back to list</button>

<script>
    var salesListReqUrl = '<?php print Yii::app()->createUrl('sales/sale/admin') ?>';	
    
    $(document).ready(function() {
        initButtons();
    });
    
    function initButtons() {
        $( "#backBtn" ).click(function() {
            location.href = salesListReqUrl;
        });
     }
    
    
</script>