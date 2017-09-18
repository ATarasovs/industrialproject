
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
<?php
//    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'List',
);

$this->menu=array(
	array('label'=>'List Sales', 'url'=>array('index')),
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
//	return false;s
//});
//");
?>

<h1>List of Sales</h1>
    <br/>
<!--    <div class="form-inline">
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
    </div>-->
<table id="sales" class="table">
    <thead class="thead-inverse">
        <th><?php echo Sale::model()->getAttributeLabel('saleID') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Date_Time') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Retailer_Name')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Outlet_Name')?></th>
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
            <td class="totalamount"><?php echo $sale->Total_Amount; ?></td>
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


