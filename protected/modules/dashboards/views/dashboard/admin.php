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
    <div class="col-md-6">
		<div class="card"> <!-- FIRST CARD WITH DOUGHNUT -->
			<h5 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white"> Quick View - Weekly Sales</p></h5>
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
				<div id="canvas-holder-2" style="width:30%; direction:ltr; margin-left:0; margin-right:auto; display:table;">
					<canvas id="myDoughnutChart" width="750" height="550"/>
				</div>
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
    <div class="col-md-6">
		<div class="card"> <!-- SECOND CARD WITH UNSUSED CHART -->
			<h6 class="card-header  bg-primary" style="background: #153465!important;">Quick View - YoYo Usage</h6>
			<div class="card-block">
			<div class="dropdown pull-right">
  			<button class="btn btn-secondary dropdown-toggle pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    			Weekly
  			</button>
  			<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
    					<a class="dropdown-item pull-right" href="#">Weekly data</a>
    					<a class="dropdown-item pull-right" href="#">Monthly data</a>
    					<a class="dropdown-item pull-right" href="#">Yearly data</a>
  				</div>
				</div>
				<br>
				<div id="canvas-holder-2" style="width:40%; direction:ltr; margin-left:auto; margin-right:auto; display:table;">
					<canvas id="bar-chart-grouped" width="500" height="450"></canvas>
				</div>
				<hr>
				<h6>Quick views:</h6>
				<div class="mmenu">
					<input id="Shops" type="button" value="Shops" class="btn btn-primary"/>
					<input id="Nightlife" type="button" value="Nightlife" class="btn btn-primary" />
					<input id="Services" type="button" value="Services" class="btn btn-primary"/>
					<input id="New" type="button" value="New" class="btn btn-success"/>
					<input id="Reset" type="button" value="Reset" class="btn btn-danger pull-right"/>
				</div>
			</div>
		</div>
		</div>
	
</div>
<br>
<!-- THIRD CARD WITH DETAILED WEEKLY SALES DATA -->
<div class="card text-center">
  <div class="card-header bg-primary" style="background: #153465!important;">
    <h4><p class="text-white">Weekly Sales Data</p> </h4>
  </div>
  <div class="card-block">

  	<div class="dropdown pull-right">
  <input class="form-control" id="filterByDateFrom" name="dateFrom" placeholder="Date: From" type="text"/>
  		<button class="btn btn-secondary dropdown-toggle pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    	Select Data
  		</button>
  		<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
		  	<a class="dropdown-item pull-right" onClick="LoadLineChartData(1);" >Daily data</a>
    		<a class="dropdown-item pull-right" onClick="LoadLineChartData(7);" >Weekly data</a>
    		<a class="dropdown-item pull-right" onClick="LoadLineChartData(30);" >Monthly data</a>
    		<a class="dropdown-item pull-right" onClick="LoadLineChartData(0);" >Quarterly data</a>
  		</div>
	</div>
	<br>
		<br> <br>
		<div id="canvas-holder-2" style="width:100%; direction:ltr; margin-left:auto; margin-right:auto; display:table;">
		<canvas id="myChart" width="300" height="125"></canvas>
				</div>
		
		<hr>
				<h6>Quick views:</h6>
				<div class="mmenuLine pull-left">
					<input id="ShopsLine" type="button" value="Shops" class="btn btn-primary"/>
					<input id="NightlifeLine" type="button" value="Nightlife" class="btn btn-primary" />
					<input id="ServicesLine" type="button" value="Services" class="btn btn-primary"/>
					<input id="New" type="button" value="New" class="btn btn-success"/>
					<input id="ResetLine" type="button" value="Reset" class="btn btn-danger pull-right"/>
				</div>
  </div>
</div>
<br><br>


<!-- ############################### -->
<!-- ###	Line Chart Scripts ### -->
<!-- ############################### -->

<!-- Init Line Graph -->
<script>
var ctx = document.getElementById("myChart").getContext('2d');

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
						position: 'left',
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

						//localStorage.setItem("WeeklyChartData", JSON.stringify(resp));
						//var timeStamp = new Date().getTime();
						//localStorage.setItem("WeeklyChartData-TS", timeStamp);
									
                    }
                });

};


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


	if(length==1)
	{
		//Prepare chart axis and labels for 1 day

	} else if (length==7)
	{
		//Prepare chart axis and labels for 1 week

	} else if (length==30)
	{
		//Prepare chart axis and labels for 1 month

	} 

	//If date froom != null, pass that in also
	var date = $('#filterByDateFrom').val()

	
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
	data: {Period: period, DateFrom: date},  
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
			chartData = JSON.stringify(resp);

			//alert(Object.keys(resp[0]).length); 



			if(Object.keys(resp[0]).length == 7)
			{
				//Load Weekly Chart Data
				var weekLabels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
				myChart.config.data.labels = weekLabels;
				var counter = 0;
				myChart.data.datasets.forEach((dataset) => {
					dataset.data = resp[counter];
					counter ++;
				});
				myChart.update();
				
			} else if(Object.keys(resp[0]).length == 30)
			{
				var monthLabels = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday","Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
				myChart.config.data.labels = monthLabels;
				var counter = 0;
				myChart.data.datasets.forEach((dataset) => {
					dataset.data = resp[counter];
					counter ++;
				});
				myChart.update();

			}

			console.log(resp);
								
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

<!-- Date Picker -->
<script>
            $(document).ready(function(){
            var date_input_to=$('input[name="dateFrom"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            var options={
                format: 'yyyy/mm/dd',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };
            date_input_to.datepicker(options);
            date_input_from.datepicker(options);
            })
        </script>

<!-- End of Content -->
<?php
}
?> 





