
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
                <button id="tribeDescriptionsBtn" class="btn btn-info">View Descriptions</button>
        </div>
    </div>
    <div id="tribeDescription" class="hide">
        <?php foreach($tribes as $tribe) { ?>
        <div class="description"><b><?php echo $tribe->title; ?>:</b> <?php echo $tribe->description; ?></div>
        <?php } ?>
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
                    <option value="1">January</option>
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
                <?php 
                   echo CHtml::dropDownList('transactionType', 'transactionType',$transactionsArray, array('class' => 'form-control filterInput', 'id' => 'filterByTransactionType', 'empty' => 'Filter by transaction type'));
                ?>
            </div>
            <br/>
            
            <div id="outletnameinfo" class="hide"></div>
            <small><b>You can select multiple locations by pressing Ctrl button and selecting a location.</b></small>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <?php 
                   echo CHtml::dropDownList('outletName', 'outletName', $outletsArray, array('class' => 'form-control filterInput', 'id' => 'filterByOutletName', 'multiple' => 'multiple'));
                ?>
            </div>
            <br/>

            <div id="useridinfo" class="hide"></div>
            <small><b>You may select up to 5 users by adding "space" between user IDs</b></small>
            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                <input id="filterByUserId" type="text" class="form-control filterInput" id="inlineFormInputGroup" placeholder="Filter by user ID">
            </div>
        </div>
    </div>
    
    <div class="form-group col-md-12s">
        <button id="searchBtn" class="btn btn-primary">Search</button> &nbsp; 
        <button id="unsetFiltersBtn" class="btn btn-danger">Unset Filters</button> &nbsp; 
        <button id="createTribeBtn" class="btn btn-success">Create Tribe</button> &nbsp;
        <button id="generateChartBtn" class="btn btn-info invisible" onclick="generateChart()"> Generate Chart </button>
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
        
        <button id="saveTribeBtn" class="btn btn-success">Save tribe</button>
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


        <!-- Radar Chart --> 
        <div class=row id="radarChartB" style="display:none;">
            <div class="col-md-8">
                <div class="card"> <!-- SECOND CARD WITH UNSUSED CHART -->
                <h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white">Outlet Transaction Map</p></h4>
                        <div class="card-block">
                        <!-- Chart Canvas -->
                        <div class="radarContain">
                        <canvas id="radarChart" width="150" height="100"></canvas>
                        <div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-primary btn-block" onclick="scrollToSales()"> View outlet totals </button>
        <br><br>
        <!-- Bar Chart --> 
            <div class="col-md-12" id="barChartTop">
                <div class="card"> <!-- SECOND CARD WITH UNSUSED CHART -->
                <h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white">Outlet Totals</p></h4>
                        <div class="card-block">
                        <!-- Chart Canvas -->
                        <div class="barChartContain">
                        <canvas id="myBarChart" width="150" height="100"></canvas>
                        <div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <button class="btn btn-primary btn-block" onclick="scrollToTop()"> Back to top </button>
        <br><br>
        
        <!-- Radar Init Script -->
        <script>
            //Init chart data
            var marksData = {
            labels: [
                "DUSA The Union - Marketplace",
				"Premier Shop",
				"DJCAD Cantina",
				"Library",
				"Ninewells Shop",
				"College Shop",
				"Mono",
				"Liar Bar",
				"Air Bar",
				"Premier Shop - Yoyo Accept",
				"Level 2, Reception",
				"Floor Five",
				"Dental Café",
				"Food on Four",
                ],

            };

            var options = {
                scale: {
                    pointLabels: {
                        fontSize: 18, //label size
                    },
                },
                tooltips: {
					bodyFontSize: 16, //tooltip size
				},
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    // text: 'Outlet Transaction Spread',
                    fontSize: 26,
                }
            };

            //Create Chart
            var ctx = document.getElementById("radarChart").getContext('2d');

            var radarChart = new Chart(ctx, {
            type: 'radar',
            data: marksData,
            options: options
            });

        </script>

        <!-- BAR CHAR INIT -->
        <script>
        var myBarChart = new Chart(document.getElementById("myBarChart"), {
        type: 'bar',
        data: {
            labels: [
                    "Premier Shop",
                    "DJCAD Cantina",
                    "Library",
                    "Ninewells Shop",
                    "College Shop",
                    "Mono",
                    "Liar Bar",
                    "Air Bar",
                    "Level 2, Reception",
                    "Floor Five",
                    "Dental Café",
                    "Food on Four",
                ],
                datasets:[
                 
                ]
        },
        options: {
            tooltips: {
                bodyFontSize: 20,
            },
            legend: {
                position: 'top',
            },
        title: {
            display: true,
            text: 'Sales totals YoYo Wallet vs Other'
        },
        scales: {
        xAxes: [{
            stacked: false,
            beginAtZero: true,
            scaleLabel: {
                labelString: 'Month'
            },
            ticks: {
                stepSize: 1,
                min: 0,
                autoSkip: false
            },
            
        }]
    }
        }
    });
            
                
        </script>

        <script>
            function generateChart()
            {
                document.getElementById('radarChartB').style.display = "block";
                document.getElementById('generateChartBtn').style.display = "none";

                

                setRadarLabels();

                $('html, body').animate({
                    scrollTop: $("#radarChartB").offset().top
                }, 2000);


            }

            function setRadarLabels()
            {
                labelsArr = [];

                <?php foreach($outletsA as $outlet) { ?>
                    labelsArr[labelsArr.length] ="<?php echo $outlet; ?>";
                <?php } ?>

                radarChart.data.labels = labelsArr;
                myBarChart.data.labels = labelsArr;
                radarChart.update();
                setRadarData();


            }


            function setRadarData()
            {
                //Get usernames
                userIDs =[];
                <?php foreach($users as $user) { ?>
                    userIDs[userIDs.length] ="<?php echo $user; ?>";
                <?php } ?>

                var counter = 0;
                <?php foreach($userTotals as $total) { ?>
                    addRadarDataSet(<?php echo json_encode($total); ?>, userIDs[counter]);
                    counter++;
                <?php } ?>

                var counter = 0;

                

                <?php foreach($userSales as $sales) { ?>
                    addBarDataSet(<?php echo json_encode($sales); ?>, userIDs[counter]);
                    counter++;
                <?php } ?>
                
                radarChart.update();

            }

            function addRadarDataSet(dataSet, userid)
            {
                var rgb = getRandomRgb();

                radarChart.data.datasets.push({
                    label: userid,
                    backgroundColor: rgb,
                    borderColor: rgb,
                    borderWidth: 5,
                    data: dataSet
                });
                radarChart.update();

            }

            function scrollToSales()
            {
                $('html, body').animate({
                    scrollTop: $("#barChartTop").offset().top
                }, 2000);

            }

            function scrollToTop()
            {
                $('html, body').animate({
                    scrollTop: $("#navtop").offset().top
                }, 2000);

            }

            function addBarDataSet(dataSet, userid)
            {
                var rgb = getRandomRgb();

                myBarChart.data.datasets.push({
                    label: userid,
                    backgroundColor: rgb,
                    borderColor: rgb,
                    borderWidth: 5,
                    data: dataSet
                });

                myBarChart.update();
            }

            function getRandomRgb() {
                var num = Math.round(0xffffff * Math.random());
                var r = num >> 16;
                var g = num >> 8 & 255;
                var b = num & 255;
                return 'rgba(' + r + ', ' + g + ', ' + b + ',0.3)';
            }

        </script>



