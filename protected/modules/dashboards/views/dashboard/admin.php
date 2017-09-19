
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Dashboard'=>array('index'),
	'List',
);

$this->menu=array(
	array('label'=>'Dashboard', 'url'=>array('index')),
);
?>

<h1>Dashboard</h1>
    <br/>
    <div class="form-group col-md-5">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <input id="filterBySaleId" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Filter by Sale ID">
        </div>


        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
            <input id="filterByDate" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by date">
        </div>


        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <input id="filterByTime" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Filter by time">
        </div>
        
        <div id="hidden" class="hide">
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByRetailerName" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by retailer name">
            </div>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByOutletName" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by outlet name">
            </div>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByUserId" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by user ID">
            </div>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByTransactionType" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by transaction type">
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <button id="advancedFiltersBtn" class="btn btn-primary">Advanced Filters</button> &nbsp;
        <button id="searchBtn" class="btn btn-primary">Search</button> &nbsp; 
        <button id="unsetFiltersBtn" class="btn btn-primary">Unset Filters</button>
    </div>
   
<table id="sales" class="table">
    <thead class="thead-inverse">
        <th><?php echo Sale::model()->getAttributeLabel('sales_id') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Date_Time') ?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Retailer_Name')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Outlet_Name')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('New_user_id')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Transaction_Type')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Cash_Spent')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Discount_Amount')?></th>
        <th><?php echo Sale::model()->getAttributeLabel('Total_Amount')?></th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach($dashboards as $dashboard) { ?>
        <tr class="table-info">
            <td class="id"><?php echo $dashboard->sales_id; ?></td>
            <td class="datetime"><?php echo $dashboard->Date_Time; ?></td>
            <td class="retailername"><?php echo $dashboard->Retailer_Name; ?></td>
            <td class="outletname"><?php echo $dashboard->Outlet_Name; ?></td>
            <td class="userid"><?php echo $dashboard->New_user_id; ?></td>
            <td class="transactiontype"><?php echo $dashboard->Transaction_Type; ?></td>
            <td class="cashspent"><?php echo $dashboard->Cash_Spent; ?></td>
            <td class="discountamount"><?php echo $dashboard->Discount_Amount; ?></td>
            <td class="totalamount"><?php echo $dashboard->Total_Amount; ?></td>
            <td>
                    <button class="viewBtn"><i class="fa fa-eye" aria-hidden="true"></i> View</button>
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
    var salesListReqUrl = '<?php print Yii::app()->createUrl('dashboards/dashboard/admin') ?>';	
    var salesViewReqUrl = '<?php print Yii::app()->createUrl('dashboards/dashboard/view') ?>';
</script>


