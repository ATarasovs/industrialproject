
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<!-- Date Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

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
    <button id="import">
        import
    </button>
    <br><br>
    <div class="form-group col-md-5">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            
            <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></i></div>
            <!--<input id="filterByDateFrom" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="From">-->
            <input class="form-control" id="filterByDateFrom" name="dateFrom" placeholder="Date: From" type="text"/>

            <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
            <!--<input id="filterByDateTo" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="To">-->
            <input class="form-control" id="filterByDateTo" name="dateTo" placeholder="Date: To" type="text"/> 
       
        </div>
        <br>

        


        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <input id="filterByTimeFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="From"> 
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <input id="filterByTimeTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="To">
        </div>
        <br>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <select id="filterByWeekdayFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="From">
                <option></option>
                <option value="0">Monday</option>
                <option value="1">Tuesday</option>
                <option value="2">Wednesday</option>
                <option value="3">Thursday</option>
                <option value="4">Friday</option>
                <option value="5">Saturday</option>
                <option value="6">Sunday</option>
            </select>
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <select id="filterByWeekdayTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="To">
                <option></option>
                <option value="0">Monday</option>
                <option value="1">Tuesday</option>
                <option value="2">Wednesday</option>
                <option value="3">Thursday</option>
                <option value="4">Friday</option>
                <option value="5">Saturday</option>
                <option value="6">Sunday</option>
            </select>
        </div>
        <br>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <select id="filterByYear" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="From">
                <option>Select years</option> 
<!--                <option value="0">Monday</option>
                <option value="1">Tuesday</option>
                <option value="2">Wednesday</option>
                <option value="3">Thursday</option>
                <option value="4">Friday</option>
                <option value="5">Saturday</option>
                <option value="6">Sunday</option>-->
            </select>
            <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
            <select id="filterByMonth" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="To">
                <option>Select months</option> 
            </select>
        </div>
        <br>
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
        <th class="hide"><?php echo Sale::model()->getAttributeLabel('sales_id') ?></th>
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
        <?php foreach($sales as $sale) { ?>
        <tr class="table-info">
            <td class="id hide"><?php echo $sale->sales_id; ?></td>
            <td class="datetime"><?php echo $sale->Date_Time; ?></td>
            <td class="retailername"><?php echo $sale->Retailer_Name; ?></td>
            <td class="outletname"><?php echo $sale->Outlet_Name; ?></td>
            <td class="userid"><?php echo $sale->New_user_id; ?></td>
            <td class="transactiontype"><?php echo $sale->Transaction_Type; ?></td>
            <td class="cashspent"><?php echo $sale->Cash_Spent; ?></td>
            <td class="discountamount"><?php echo $sale->Discount_Amount; ?></td>
            <td class="totalamount"><?php echo $sale->Total_Amount; ?></td>
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
    var salesListReqUrl = '<?php print Yii::app()->createUrl('sales/sale/admin') ?>';	
    var salesViewReqUrl = '<?php print Yii::app()->createUrl('sales/sale/view') ?>';
    var salesImportReqUrl = '<?php print Yii::app()->createUrl('sales/sale/importexcel') ?>';
</script>

<!-- Date Picker -->
<script>
            $(document).ready(function(){
            flatpickr("#filterByDateFrom", {});
            flatpickr("#filterByDateTo", {});

            flatpickr("#filterByTimeFrom", {
                enableTime: true,
                noCalendar: true,

                enableSeconds: false, // disabled by default

                time_24hr: false, // AM/PM time picker is used by default

                // default format
                dateFormat: "H:i", 

                // initial values for time. don't use these to preload a date
                defaultHour: 12,
                defaultMinute: 0

                // Preload time with defaultDate instead:
                // defaultDate: "3:30"
            });
            flatpickr("#filterByTimeTo", {
                enableTime: true,
                noCalendar: true,

                enableSeconds: false, // disabled by default

                time_24hr: false, // AM/PM time picker is used by default

                // default format
                dateFormat: "H:i", 

                // initial values for time. don't use these to preload a date
                defaultHour: 12,
                defaultMinute: 0

                // Preload time with defaultDate instead:
                // defaultDate: "3:30"
            });
            })
        </script>


