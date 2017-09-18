
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'List',
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
);
?>

<h1>List of Sales</h1>
    <br/>
    <div class="row">
        <div class="col-xs-4">
    </div>
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
    </div>
<!--    <div>
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
        </div>
    </div>-->

        <button id="advancedFiltersBtn" class="btn btn-primary">Advanced Filters</button> &nbsp;
        <button id="searchBtn" class="btn btn-primary">Search</button> &nbsp; 
        <button id="unsetFiltersBtn" class="btn btn-primary">Unset Filters</button>
    </div>
<table id="sales" class="table">
    <thead class="thead-inverse">
        <th><?php echo Sale::model()->getAttributeLabel('saleID') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Date_Time') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Retailer_Name')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Outlet_Name')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('New_User_ID')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Transaction_Type')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Cash_Spent')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Discount_Amount')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Total_Amount')?></th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($sales as $sale) { ?>
        <tr class="table-info">
            <td class="id"><?php echo $sale->saleID; ?></td>
            <td class="datetime"><?php echo $sale->Date_Time; ?></td>
            <td class="retailername"><?php echo $sale->Retailer_Name; ?></td>
            <td class="outletname"><?php echo $sale->Outlet_Name; ?></td>
            <td class="userid"><?php echo $sale->New_User_ID; ?></td>
            <td class="transactiontype"><?php echo $sale->Transaction_Type; ?></td>
            <td class="cashspent"><?php echo $sale->Cash_Spent; ?></td>
            <td class="discountamount"><?php echo $sale->Discount_Amount; ?></td>
            <td class="totalamount"><?php echo $sale->Total_Amount; ?></td>
            <td>
                    <button class="viewBtn"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
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


