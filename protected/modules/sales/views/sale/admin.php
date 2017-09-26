
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<!-- Date Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales list',
);

if(Yii::app()->user->hasFlash('success')) { ?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?> <br/>
    </div>
<?php } 

if(Yii::app()->user->hasFlash('successTribeSave')) { ?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('successTribeSave'); ?> <br/>
    </div>
<?php } 

if(Yii::app()->user->hasFlash('errorTribeSave')) { ?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('errorTribeSave'); ?> <br/>
    </div>
<?php } ?>


<h1>List of Sales</h1>
    <br/>
    <div class="row">
        <div class="col-md-12">
            <?php foreach($tribes as $tribe) { ?>
                <button value="<?php echo $tribe->dateFrom; ?>;<?php echo $tribe->dateTo; ?>;<?php echo $tribe->timeFrom; ?>;<?php echo $tribe->timeTo; ?>;<?php echo $tribe->weekdayFrom; ?>;<?php echo $tribe->weekdayTo; ?>;<?php echo $tribe->year; ?>;<?php echo $tribe->month; ?>;<?php echo $tribe->totalAmountFrom; ?>;<?php echo $tribe->totalAmountTo; ?>;<?php echo $tribe->retailer; ?>;<?php echo $tribe->outletName; ?>;<?php echo $tribe->transactionType; ?>;<?php echo $tribe->new_user_ID; ?>;" class="tribeBtn btn btn-primary"><?php echo $tribe->title; ?></button>
            <?php } ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="form-group col-md-6">
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></i></div>
                <input class="form-control" id="filterByDateFrom" name="dateFrom" placeholder="Date from:" type="text"/>

                <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
                <input class="form-control" id="filterByDateTo" name="dateTo" placeholder="Date to:" type="text"/> 

            </div>
            <br>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <input id="filterByTimeFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time from:"> 

                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <input id="filterByTimeTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time to:">
            </div>
            <br>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <select id="filterByWeekdayFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Weekday from">
                    <option value="">Weekday from:</option>
                    <option value="0">Monday</option>
                    <option value="1">Tuesday</option>
                    <option value="2">Wednesday</option>
                    <option value="3">Thursday</option>
                    <option value="4">Friday</option>
                    <option value="5">Saturday</option>
                    <option value="6">Sunday</option>
                </select>
                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <select id="filterByWeekdayTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Weekday to">
                    <option value="">Weekday to:</option>
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
                <select id="filterByYear" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Year">
                    <!-- These are hard coded at the moment. Will work on so that these values are generated from the data in the Database --> 
                    <option value="">Select year</option> 
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                </select>
                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <select id="filterByMonth" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Month">
                    <option value="">Select month</option>
                    <option value="1">Janurary</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <br>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <input id="filterByTotalAmountFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Total amount from:"> 

                <div class="input-group-addon"><i class="fa fa-list-ol" aria-hidden="true"></i></div>
                <input id="filterByTotalAmountTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Total amount to:">
            </div>
        </div>
        <div class="form-group col-md-6">
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByRetailerName" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by retailer" disabled="disabled">
            </div>
            <br/>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <?php 
                   echo CHtml::dropDownList('outletName', 'outletName', $outletsArray, array('class' => 'form-control filterInput', 'id' => 'filterByOutletName', 'empty' => 'Filter by outlet name'));
                ?>
                <!--<input id="filterByOutletName" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by outlet name">-->
            </div>
            <br/>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <?php 
                   echo CHtml::dropDownList('transactionType', 'transactionType',$transactionsArray, array('class' => 'form-control filterInput', 'id' => 'filterByTransactionType', 'empty' => 'Filter by transaction type'));
                ?>
                    <!--<input id="filterByTransactionType" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by transaction type">-->
            </div>
            <br/>

            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByUserId" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by user ID">
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <button id="searchBtn" class="btn btn-primary">Search</button> &nbsp; 
        <button id="unsetFiltersBtn" class="btn btn-primary">Unset Filters</button> &nbsp; 
        <button id="createTribeBtn" class="btn btn-primary">Create Tribe</button> &nbsp;
    </div>
    <div class="col-md-4 hide" id="createTribe">
        <h4> Create Tribe </h4>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
            <input id="title" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Title:">
        </div> <br/>
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
            <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
            <textarea id="description" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Description:"></textarea>
        </div><br/>
        <button id="saveTribeBtn" class="btn btn-primary">Save tribe</button>
    </div> <br/>
   
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
            <td class="cashspent"><?php echo "£" . substr($sale->Cash_Spent, 0, -2); ?></td>
            <td class="cashspent"><?php echo "£" . substr($sale->Discount_Amount, 0, -2); ?></td>
            <td class="cashspent"><?php echo "£" . substr($sale->Total_Amount, 0, -2); ?></td>
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
    var saveTribeReqUrl = '<?php print Yii::app()->createUrl('sales/sale/savetribe') ?>';
    var userId = <?php print Yii::app()->user->getId(); ?>
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


