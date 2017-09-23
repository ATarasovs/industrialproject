<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);

//$this->breadcrumbs=array(
//	'Dashboard'=>array('index'),
//	'List',
//);

?>

<script>
    var salesListReqUrl = '<?php print Yii::app()->createUrl('dashboards/dashboard/admin') ?>';	
    var salesViewReqUrl = '<?php print Yii::app()->createUrl('dashboards/dashboard/view') ?>';
</script> 

<!--        START OF ORIGINAL DASHBOARD         -->
<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui');

echo $URL;

$this->pageTitle=Yii::app()->name;
?>



<?php if (Yii::app()->user->isGuest) { ?>

    

	<div class="jumbotron">
  <h1 class="display-3">Welcome to DUSA Analytics!</h1>
  <p class="lead">Providing all-new insights into DUSA sales data.</p>
  <hr class="my-4">
  <p>To begin using the DUSA Analytics dashbord, please sign in using the details provided by your administrator.</p>
  <p class="lead">
	<?php echo CHtml::link('<i class="fa fa-sign-in"></i> Login',array('/site/login'), array('class'=>'btn btn-success btn-lg')); ?>
  </p>
</div>

<?php
} else { 

	?>
	<div class="card text-center">
  <div class="card-header bg-primary" style="background: #153465!important;">
    <h4> <p class="text-white"> Quick Links </p> </h4>
  </div>
  <div class="card-block">
    <h4 class="card-title">DUSA Analytics Dashboard</h4>
    <p class="card-text">Use the buttons below to navigate to different analytics</p>
    <a href="#" class="btn btn-primary">Weekly Sales View</a>
		<a href="#" class="btn btn-primary">Monthly Sales View</a>
		<a href="#" class="btn btn-primary">Calendar View</a>
  </div>
  <div class="card-footer text-muted" style="background: #153465!important;">
    -
  </div>
</div>
<br>
<!-- FIRST AND SECOND CARDS WITH SUMMARY OF WEEKLY SALES DATA -->	

  <div class="row">
    <div class="col-md-7">
  <br>
		<div class="card"> <!-- FIRST CARD WITH DOUGHNUT -->
			<h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white"><i class="fa fa-pie-chart" aria-hidden="true"></i> Sales Summary Data</p></h4>
			<div class="card-block">
			<div class="dropdown pull-right">
  			<button class="btn btn-secondary dropdown-toggle pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    		Select Data
  			</button>
  			<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
    					<a class="dropdown-item pull-right" onClick="LoadDougnutData(1);" >Weekly data</a>
    					<a class="dropdown-item pull-right" onClick="LoadDougnutData(4);" >Monthly data</a>
    					<a class="dropdown-item pull-right" onClick="LoadDougnutData(12);" >Quarterly data</a>
  				</div>
				</div>
				<br>
					<canvas id="myDoughnutChart" width="750" height="550"/>
				<hr>
				<h6>Quick views:</h6>
				<div class="mmenu">
					<input id="Shops" type="button" value="Shops" class="btn btn-primary"/>
					<input id="Nightlife" type="button" value="Nightlife" class="btn btn-primary" />
					<input id="Services" type="button" value="Services" class="btn btn-primary"/>
					<input id="New" type="button" value="New" class="btn btn-success"/>
					<span>
						<input id="Reset" type="button" value="Reset" class="btn btn-danger pull-right"/>
					</span>
				</div>
			</div>
		</div>
		</div>	
    <div class="col-sm-5">
	<br>
		<div class="card"> <!-- SECOND CARD WITH UNSUSED CHART -->
		<h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white"><i class="fa fa-calendar" aria-hidden="true"></i> Calendar View</p></h4>
			<div class="card-block">
				<div id="canvas-holder-2" style="width:40%; direction:ltr; margin-left:auto; margin-right:auto; display:table;">

				<!-- CALENDAR GOES HERE -->

				</div>
			</div>
		</div>
		</div>
	
</div>
<br>
<!-- THIRD CARD WITH DETAILED WEEKLY SALES DATA -->
<div class="card text-left">
  <div class="card-header bg-primary" style="background: #153465!important;">
    <h4><p class="text-white"><i class="fa fa-line-chart" aria-hidden="true"></i> Sales Data Viewer</p> </h4>
  </div>
  <div class="card-block">
  <div id="noFiltersDiv" style="display:inline;" class="pull-left">
		<button name="answer" class="btn btn-primary pull-left" id="filtersButton" onclick="showDiv()"><i class="fa fa-filter" aria-hidden="true"></i> Show Advanced Filters </button> &nbsp; &nbsp;
		</div>
  <div class="form-inline">
		<input class="form-control" id="filterByDateFrom" name="dateFrom" placeholder="Date: From" type="text"/>&nbsp;
		<input class="form-control" id="filterByDateTo" name="dateTo" placeholder="Date: To" type="text"/> &nbsp;
		<button class="btn btn-success" id="applyFilters" type="submit" value="Apply" onClick="LoadLineChartData(7)">Apply</button> &nbsp;
	</div>
	<!-- FILTERS HIDDEN DIV -->
	<div id="filtersDiv"  style="display:none;" class="pull-left" >
	<div class="form-inline">
	<br><br>
		<button type="button" name="answer" class="btn btn-danger pull-right" id="filtersButton" onclick="hideDiv()"><i class="fa fa-minus-square" aria-hidden="true"></i> Hide Filters</button>&nbsp; 

		<!-- Time to/from -->
		<input id="filterByTimeTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time: From">&nbsp;
		<input id="filterByTimeFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time: To">&nbsp;

		<!-- FROM/TO WEEKDAY -->
		<div class="dropdown pull-right"> &nbsp;
			<button class="btn btn-secondary dropdown-toggle weekdayFromL pull-right" type="button" id="filterByWeekdayFrom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Weekday: From
			</button>
			<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(0)" >Monday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(1)" >Tuesday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(2)" >Wednesday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(3)" >Thursday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(4)" >Friday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(5)" >Saturday</a>
				<a class="dropdown-item pull-right" onClick="weekdayDropdownFrom(6)" >Sunday</a>

			</div>
		</div>

		<div class="dropdown pull-right"> &nbsp;
			<button class="btn btn-secondary dropdown-toggle weekdayToL pull-right" type="button" id="filterByWeekdayTo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
			Weekday: To
			</button>
			<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(0)" >Monday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(1)" >Tuesday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(2)" >Wednesday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(3)" >Thursday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(4)" >Friday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(5)" >Saturday</a>
			<a class="dropdown-item pull-right" onClick="weekdayDropdownTo(6)" >Sunday</a>
			</div>
		</div>
		&nbsp;

	</div>

		
	</div><!-- END OF FILTERS DIV -->
	<br><br><br><br>
		<canvas id="myChart" width="300" height="100"></canvas>
		
		<hr>
				<h6>Quick views:</h6>
				<div class="mmenuLine pull-left">
					<button id="ShopsLine" type="button" value="Shops" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Shops</button>
					<button id="NightlifeLine" type="button" value="Nightlife" class="btn btn-primary"><i class="fa fa-glass" aria-hidden="true"></i> Nightlife</button>
					<button id="ServicesLine" type="button" value="Services" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Services</button>
					<button id="New" type="button" value="New" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> New</button> &nbsp;
					<button id="ResetLine" type="button" value="Reset" class="btn btn-danger pull-right"> Reset</button>
				</div>
  </div>
</div>
<br><br>

<!-- show filters script -->
<script> 
function showDiv() {
   document.getElementById('filtersDiv').style.display = "inline";
   document.getElementById('noFiltersDiv').style.display = "none";
   //document.getElementById('filtersButton').val("Hide advanced filters");
}

function hideDiv(){
	document.getElementById('filtersDiv').style.display = "none";
   document.getElementById('noFiltersDiv').style.display = "inline";

}
</script>

<!-- ############################### -->
<!-- ###	Line Chart Scripts ### -->
<!-- ############################### -->

<!-- Init Line Graph -->
<script>
var ctx = document.getElementById("myChart").getContext('2d');


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

var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
		datasets: [{ 
			data: [0,0,0,0,0,0,0],
			label: "DUSA The Union - Marketplace",
			borderColor: "#e6194b",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "DUSA The Union Online",
			borderColor: "#3cb44b",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Online Dundee University Students Association",
			borderColor: "#ffe119",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Premier Shop",
			borderColor: "#0082c8",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "DJCAD Cantina",
			borderColor: "#f58231",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Library",
			borderColor: "#911eb4",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Ninewells Shop",
			borderColor: "#46f0f0",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "DOJ Catering",
			borderColor: "#f032e6",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Mono",
			borderColor: "#d2f53c",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Liar Bar",
			borderColor: "#fabebe",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Air Bar",
			borderColor: "#008080",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Remote Campus Shop",
			borderColor: "#e6beff",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Level 2, Reception",
			borderColor: "#aa6e28",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Floor Five",
			borderColor: "#fffac8",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Ninewells Shop",
			borderColor: "#800000",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Dental Café",
			borderColor: "#aaffc3",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Food on Four",
			borderColor: "#000080",
			fill: false
			}, 
	]
	},
	options: {
		maintainAspectRatio: true,
		responsive: true,
		legend: {
					labels:{
						fontSize: 16,

					},
						position: 'top',
				},
		tooltips: { bodyFontSize: 15 },
		elements: { point: { hitRadius: 10, hoverRadius: 5 } },
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true,
					callback: function(value, index, values){
						return '£' + value;
					}
				},
				scaleLabel: {
					display: true,
					labelString: "Total Sales (£)",
					fontColor: "green"
				}
			}],
			xAxes: [{
				scaleLabel: {
					display: true,
					labelString: "Day of the week",
					fontColor: "blue"
				}
			}]
		}
	}
});
</script>

<!-- Function which handles WEEK / MONTH data request -->



<!-- Line Graph Quick View Buttons -->
<script>
$(document).ready(function() {
	$('.mmenuLine').delegate(".btn", "click", function() {
        var id = $(this).attr('id') // or this.id
        if ( id == "ShopsLine" ) {

					Reset();
						myChart.data.datasets[2].hidden = true;
						myChart.data.datasets[3].hidden = true;
						myChart.data.datasets[4].hidden = true;
						myChart.data.datasets[5].hidden = true;
						myChart.data.datasets[7].hidden = true;
						myChart.data.datasets[8].hidden = true;
						myChart.data.datasets[9].hidden = true;
						myChart.update();

        } else if ( id == "NightlifeLine"){

							
						Reset();
						myChart.data.datasets[0].hidden = true;
						myChart.data.datasets[1].hidden = true;
						myChart.data.datasets[3].hidden = true;
						myChart.data.datasets[4].hidden = true;
						myChart.data.datasets[6].hidden = true;
						myChart.data.datasets[7].hidden = true;
						myChart.data.datasets[8].hidden = true;
						myChart.update();


				} else if ( id == "ServicesLine"){

					Reset();
					myChart.data.datasets[0].hidden = true;
					myChart.data.datasets[1].hidden = true;
					myChart.data.datasets[2].hidden = true;
					myChart.data.datasets[4].hidden = true;
					myChart.data.datasets[5].hidden = true;
					myChart.data.datasets[6].hidden = true;
					myChart.update();

				} else if ( id == "ResetLine"){

						Reset();

				} 

				function Reset(){

					myChart.data.datasets.forEach((dataset) => {
						
						dataset.hidden = false;
						
					});

					myChart.update();

				} 
    });


});
</script> 

<!-- ############################### -->
<!-- ###	Doughnut Chart Scripts ### -->
<!-- ############################### -->
<!-- Initalise Doughnut -->
<script>
 var ctx = document.getElementById("myDoughnutChart").getContext("2d");

 var myDoughnutChart = new Chart(ctx, {
		 type: 'doughnut',
		 data: {
 			labels: [
				"DUSA The Union - Marketplace",
				"DUSA The Union Online",
				"Online Dundee University Students Association",
				"Premier Shop",
				"DJCAD Cantina",
				"Library",
				"Ninewells Shop",
				"DOJ Catering",
				"College Shop",
				"Mono",
				"Liar Bar",
				"Air Bar",
				"Remote Campus Shop",
				"Level 2, Reception",
				"Floor Five",
				"Dental Café",
				"Food on Four",
			],
 datasets: [
		 {
				 data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
				 backgroundColor: [
						 "#e6194b",
						 "#3cb44b",
						 "#ffe119",
						 "#0082c8",
						 "#f58231",
						 "#911eb4",
						 "#46f0f0",
						 "#f032e6",
						 "#d2f53c",
						 "#fabebe",
						 "#008080",
						 "#e6beff",
						 "#aa6e28",
						 "#fffac8",
						 "#800000",
						 "#aaffc3",
						 "#000080"

						 
				 ],
				 hoverBackgroundColor: [
					"#e6194b",
					"#3cb44b",
					"#ffe119",
					"#0082c8",
					"#f58231",
					"#911eb4",
					"#46f0f0",
					"#f032e6",
					"#d2f53c",
					"#fabebe",
					"#008080",
					"#e6beff",
					"#aa6e28",
					"#fffac8",
					"#800000",
					"#aaffc3",
					"#000080"
				 ],
				 borderWidth: 5,
				 borderColor: "#ffffff"

		 }]
},
		 options: {
				 responsive: true,
				 maintainAspectRatio: true,
				 legend: {
						position: 'top',
				},
				 elements: {
						 arc: {
								 borderColor: "#000000"
						 }
				 }, 
				 title: {
                display: true,
                text: 'Weekly Sales - 17/09/17'
        	},
				 cutoutPercentage: 50
		 },
		 animation:{
				 animateScale: true
		 },
 });



 //Load Weekly Summary Data
//LoadDougnutData(3);

function LoadDougnutData(length)
{
	//Change drop-down text
	if(length == 1)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Weekly"); 
	} else if (length == 4)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Monthly"); 
	} else if (length == 12)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Quarterly"); 
	}


	var a = length; 
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=dashboards/dashboard/TestCall',
                type: "POST",
                data: {ajaxData: a},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						//Assign Data to Chart
						//alert(Object.keys(resp).length); 

						console.log(JSON.stringify(resp));
						myDoughnutChart.data.datasets[0].data =resp;
						myDoughnutChart.update();

                    }
                });

};


function weekdayDropdownTo(val)
{
	if(val == 0)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Monday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(0); 
	} else if (val == 1)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Tuesday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(1); 
	} else if (val == 2)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Wednesday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(2); 
	} else if (val == 3)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Thursday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(3); 
	} else if (val == 4)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Friday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(4); 
	} else if (val == 5)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Saturday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(5); 
	} else if (val == 6)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").text("Sunday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayToL").val(6); 
	}

}

function weekdayDropdownFrom(val)
{
	if(val == 0)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Monday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(0); 
	} else if (val == 1)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Tuesday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(1); 
	} else if (val == 2)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Wednesday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(2); 
	} else if (val == 3)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Thursday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(3); 
	} else if (val == 4)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Friday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(4); 
	} else if (val == 5)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Saturday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(5); 
	} else if (val == 6)
	{
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").text("Sunday");
		$(".btn.btn-secondary.dropdown-toggle.weekdayFromL").val(6); 
	}

}

function LoadLineChartData(length)
{
	//Change drop-down text
	if(length == 1)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Weekly"); 
	} else if (length == 4)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Monthly"); 
	} else if (length == 12)
	{
		$(".btn.btn-secondary.dropdown-toggle").text("Quarterly"); 
	}

	document.getElementById('applyFilters').innerHTML ='<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>';


	//If date froom != null, pass that in also
	var date = $('#filterByDateFrom').val();
	var dateTo = $('#filterByDateTo').val();

	var timeFrom = $('#filterByTimeFrom').val();
	var timeTo = $('#filterByTimeTo').val();

	var weekdayFrom = $('#filterByWeekdayFrom').val();
	var weekdayTo = $('#filterByWeekdayTo').val();

	console.log(weekdayFrom, weekdayTo)

	//Identifier for ajaxProcess function to load correct chartData
	var period = length;

	//Global varibale which stores 2d array of chart values
	var chartData;

	//AJAX call to siteController actionAjaxProcess
	jQuery.ajax({
	// The url must be appropriate for your configuration;
	// this works with the default config of 1.1.11
	url: 'index.php?r=dashboards/dashboard/LoadLineChartData',
	type: "POST",
	data: {Period: period, DateFrom: date, DateTo: dateTo, TimeFrom: timeFrom, TimeTo: timeTo, WeekdayFrom: weekdayFrom, WeekdayTo: weekdayTo},  
	error: function(xhr,tStatus,e){
				if(!xhr){
					alert(" We have an error ");
					alert(tStatus+"   "+e.message);
				}else{
						alert("else: "+e.message); // the great unknown
				}
			},
			success: function(resp){


				
				if(resp==""){
					document.getElementById('applyFilters').innerHTML ='Apply';
					return;
				}

				if(resp[0].length == 10)
				{
					//Load Chart Data
					var customlblset = ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00" , "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00"];

					var counter = 1;
					myChart.data.datasets.forEach((dataset) => {
						dataset.data = resp[counter];
						counter ++;
					});

					myChart.config.data.labels = customlblset;
					myChart.update();
					document.getElementById('applyFilters').innerHTML ='Apply';
					return;
					
				}
				

				//Assign Data to Chart
				chartData = JSON.stringify(resp);
	
				console.log(resp);
				//Generate labels based on custom dataset length

				//Array for weekday axis labels
				var weekday = new Array(7);
				weekday[0] = "Sunday";
				weekday[1] = "Monday";
				weekday[2] = "Tuesday";
				weekday[3] = "Wednesday";
				weekday[4] = "Thursday";
				weekday[5] = "Friday";
				weekday[6] = "Saturday";


				function getPrefix(date){
					if(date == 1 || date == 21 || date == 31){
						return "st";
					} else if (date ==2 || date ==22 )
					{
						return "nd";
					} else if (date ==3)
					{
						return "rd";

					} else 
					{
						return "th";
					}

				}

				var from = resp[0][0].split("-");
				var date = new Date(from[0], (from[1]-1), from[2]);

				var customLabelSet = [];

				//Load Axis labels
				for(var i =1; i<Object.keys(resp[1]).length+1; i++)
				{
					var from = resp[0][i-1].split("-");
					var date = new Date(from[0], (from[1]-1), from[2]);

					customLabelSet[i-1] = weekday[date.getDay()] + " " + date.getDate() + getPrefix(date.getDate());
					date.setDate(date.getDate()+1); 

				}

				//Load Chart Data
				var counter = 1;
				myChart.data.datasets.forEach((dataset) => {
					dataset.data = resp[counter];
					counter ++;
				});

				myChart.config.data.labels = customLabelSet;
				myChart.update();
				
				document.getElementById('applyFilters').innerHTML ='Apply';
			
								
			}
	});

}

 
</script>

<!-- Dougnut Quick View Buttons -->
<script>
jQuery(document).ready(function() {
	$('.mmenu').delegate(".btn", "click", function() {
        var id = $(this).attr('id') // or this.id
        if ( id == "Shops" ) {

						Reset();

						myDoughnutChart.getDatasetMeta(0).data[2].hidden = !myDoughnutChart.getDatasetMeta(0).data[2].hidden;
						myDoughnutChart.getDatasetMeta(0).data[3].hidden = !myDoughnutChart.getDatasetMeta(0).data[3].hidden;
						myDoughnutChart.getDatasetMeta(0).data[4].hidden = !myDoughnutChart.getDatasetMeta(0).data[4].hidden;
						myDoughnutChart.getDatasetMeta(0).data[5].hidden = !myDoughnutChart.getDatasetMeta(0).data[5].hidden;
						myDoughnutChart.getDatasetMeta(0).data[7].hidden = !myDoughnutChart.getDatasetMeta(0).data[7].hidden;
						myDoughnutChart.update();

        } else if ( id == "Nightlife"){

						Reset();
						myDoughnutChart.getDatasetMeta(0).data[0].hidden = !myDoughnutChart.getDatasetMeta(0).data[0].hidden;
						myDoughnutChart.getDatasetMeta(0).data[1].hidden = !myDoughnutChart.getDatasetMeta(0).data[1].hidden;
						myDoughnutChart.getDatasetMeta(0).data[3].hidden = !myDoughnutChart.getDatasetMeta(0).data[3].hidden;
						myDoughnutChart.getDatasetMeta(0).data[6].hidden = !myDoughnutChart.getDatasetMeta(0).data[6].hidden;
						myDoughnutChart.getDatasetMeta(0).data[7].hidden = !myDoughnutChart.getDatasetMeta(0).data[7].hidden;
						myDoughnutChart.update();


				} else if ( id == "Services"){

						Reset();
						myDoughnutChart.getDatasetMeta(0).data[0].hidden = !myDoughnutChart.getDatasetMeta(0).data[0].hidden;
						myDoughnutChart.getDatasetMeta(0).data[1].hidden = !myDoughnutChart.getDatasetMeta(0).data[1].hidden;
						myDoughnutChart.getDatasetMeta(0).data[2].hidden = !myDoughnutChart.getDatasetMeta(0).data[2].hidden;
						myDoughnutChart.getDatasetMeta(0).data[4].hidden = !myDoughnutChart.getDatasetMeta(0).data[4].hidden;
						myDoughnutChart.getDatasetMeta(0).data[5].hidden = !myDoughnutChart.getDatasetMeta(0).data[5].hidden;
						myDoughnutChart.getDatasetMeta(0).data[6].hidden = !myDoughnutChart.getDatasetMeta(0).data[6].hidden;
						myDoughnutChart.update();

				} else if ( id == "Reset"){

						Reset();

				} 

				function Reset(){

					for(var i=0; i<17; i++){
						myDoughnutChart.getDatasetMeta(0).data[i].hidden = false;
					}

						myDoughnutChart.update();

				} 
    });


});
</script> 

<!-- BAR CHART -->
<script>
var myBarChart = new Chart(document.getElementById("bar-chart-grouped"), {
    type: 'bar',
    data: {
      labels: ["Current Week", "Previous Week"],
      datasets: [
        {
          label: "YoYo Sales",
          backgroundColor: "#3e95cd",
          data: [268,321]
        }, {
          label: "Total Sales",
          backgroundColor: "#8e5ea2",
          data: [408,547]
        }
      ]
    },
    options: {
      title: {
        display: true,
        text: 'Sales totals YoYo Wallet vs Other'
      }
    }
});
</script>

<?php
}
?> 





