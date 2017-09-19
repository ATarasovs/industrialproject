<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui');



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
  <div class="card-header">
    Quick Links
  </div>
  <div class="card-block">
    <h4 class="card-title">DUSA Analytics Dashboard</h4>
    <p class="card-text">Use the buttons below to navigate to different analytics</p>
    <a href="#" class="btn btn-primary">Weekly Sales View</a>
		<a href="#" class="btn btn-primary">Monthly Sales View</a>
		<a href="#" class="btn btn-primary">Calendar View</a>
  </div>
  <div class="card-footer text-muted">
    -
  </div>
</div>
<br>
<!-- FIRST AND SECOND CARDS WITH SUMMARY OF WEEKLY SALES DATA -->	

  <div class="row">
    <div class="col-md-6">
		<div class="card"> <!-- FIRST CARD WITH DOUGHNUT -->
			<h6 class="card-header">Quick View - Weekly Sales</h6>
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
				<div id="canvas-holder-2" style="width:40%; direction:ltr; margin-left:0; margin-right:auto; display:table;">
					<canvas id="myDoughnutChart" width="500" height="450"/>
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
			<h6 class="card-header">Quick View - YoYo Usage</h6>
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
  <div class="card-header">
    Weekly Sales Data
  </div>
  <div class="card-block">
    <h4 class="card-title">Sales Data</h4>
		<input id="btn" type="button" value="Week" class="btn btn-primary" />
		<input id="btn" type="button" value="Month" class="btn btn-primary" />
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
			label: "Premier Shop",
			borderColor: "#3e95cd",
			fill: false,
			hidden: true
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Ninewells Shop",
			borderColor: "#8e5ea2",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Mono",
			borderColor: "#3cba9f",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Library",
			borderColor: "#ffe835",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Liar Bar",
			borderColor: "#2e50ff",
			fill: false
			},  { 
			data: [0,0,0,0,0,0,0],
			label: "Level 2 Reception",
			borderColor: "#5ba921",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "College Shop",
			borderColor: "#b87e7a",
			fill: false
			}, { 
			data: [0,0,0,1,0,0,0],
			label: "DUSA Marketplace",
			borderColor: "#3fcaee",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "DJCAD Canteen",
			borderColor: "#873de2",
			fill: false
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Food On Four",
			borderColor: "#886302",
			fill: false
			}  
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

<!-- Function which handles button request -->
<script>
		jQuery(document).ready(function() {
			$('#btn').click(function() {

				//Identifier for ajaxProcess function to load correct chartData
				var a = "Week";

				//Global varibale which stores 2d array of chart values
				var chartData;

				//AJAX call to siteController actionAjaxProcess
				jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=site/AjaxProcess',
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
									chartData = JSON.stringify(resp);

											var counter = 0;
											myChart.data.datasets.forEach((dataset) => {

													dataset.data = resp[counter];
													counter ++;

											});
									
											myChart.update();
									
                    }
                });
				});
			}); 
		</script>


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
					"Premier Shop",
					"Ninewells Shop",
					"Mono",
					"Library",
					"Liar Bar",
					"Level 2 Reception",
					"College Shop",
					"DUSA Marketpalce"
			],
 datasets: [
		 {
				 data: [909.69, 96.28, 4243.51, 61.13, 3409.11, 1644.50, 42.33, 9321.00],
				 backgroundColor: [
						 "#e6194b",
						 "#3cb44b",
						 "#ffe119",
						 "#0082c8",
						 "#f58231",
						 "#911eb4",
						 "#46f0f0",
						 "#f032e6"
				 ],
				 hoverBackgroundColor: [
					"#e6194b",
					"#3cb44b",
					"#ffe119",
					"#0082c8",
					"#f58231",
					"#911eb4",
					"#46f0f0",
					"#f032e6"
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
</script>

<!-- Dougnut Quick View Buttons -->
<script>
jQuery(document).ready(function() {
	$('.mmenu').delegate(".btn", "click", function() {
        var id = $(this).attr('id') // or this.id
        if ( id == "Shops" ) {

						Reset();
						console.log(myDoughnutChart.getDatasetMeta(0).data[2]);

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

					myDoughnutChart.getDatasetMeta(0).data[0].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[1].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[2].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[3].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[4].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[5].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[6].hidden = false;
						myDoughnutChart.getDatasetMeta(0).data[7].hidden = false;

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

<!-- End of Content -->
<?php
}
?>

