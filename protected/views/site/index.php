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
<div class="container">
  <div class="row">
    <div class="col-sm-6">
		<div class="card">
			<h6 class="card-header">Quick View - Weekly Sales</h6>
			<div class="card-block">
				<div id="canvas-holder-2" style="width:40%; direction:ltr; margin-left:auto; margin-right:auto; display:table;">
				<canvas id="chart-area" width="400" height="400"/>
				</div>
			</div>
		</div>
		</div>	
    <div class="col-sm-6">
		<div class="card">
			<h6 class="card-header">Quick View - YoYo Usage</h6>
			<div class="card-block">
				<div id="canvas-holder-2" style="width:40%; direction:ltr; margin-left:auto; margin-right:auto; display:table;">
				<canvas id="bar-chart-grouped" width="450" height="400"></canvas>
				</div>
			</div>
		</div>
		</div>
	</div>
	<div class="row">
	<div class="col-sm-6">
		
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
		<input id="btn" type="button" value="Day" class="btn btn-primary" />
		<input id="btn" type="button" value="Week" class="btn btn-primary" />
		<input id="btn" type="button" value="Month" class="btn btn-primary" />
		<hr>
		<br>

		<canvas id="myChart" width="300" height="150"></canvas>
		<!-- Function which handles button request -->
		<script>
		$(document).ready(function() {
			$('#btn').click(function() {
				myChart.data.datasets[0].data[2] = 555; //test chart animation
				myChart.update();	


				//$("#content").load("");			
			});
		}); 
		</script>

  </div>
</div>
<br><br>


<!-- LOAD DATA FOR FIRST CHART -->
<script>
var doughnutData = {
 labels: [
		 "Air Bar",
		 "Mono",
		 "Union Shop",
		 "Floor 5",
		 "Online"
 ],
 datasets: [
		 {
				 data: [43, 45, 80, 89, 88],
				 backgroundColor: [
						 "#ec8316",
						 "#AF23A5",
						 "#66008C",
						 "#568E14",
						 "#00829B"
				 ],
				 hoverBackgroundColor: [
						 "#ff8300",
						 "#9d3292",
						 "#522e91",
						 "#5d9632",
						 "#0083a8"
				 ],
				 borderWidth: 0.2
		 }]
};

jQuery(document).ready(function() {
 var ctx = document.getElementById("chart-area").getContext("2d");

 window.myDoughnutChart = new Chart(ctx, {
		 type: 'doughnut',
		 data: doughnutData,
		 options: {
				 responsive: true,
				 legend: {
						position: 'bottom',
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
});
</script>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
		datasets: [{ 
			data: [86,114,106,76,134,111,200,221],
			label: "Air-bar",
			borderColor: "#3e95cd",
			fill: false
			}, { 
			data: [0,350,0,0,405,809,0],
			label: "Mono",
			borderColor: "#8e5ea2",
			fill: false
			}, { 
			data: [265,70,378,190,42,276,408,123,400,34],
			label: "Union Shop",
			borderColor: "#3cba9f",
			fill: false
			}, { 
			data: [165,170,178,90,34,76,148,23,250,334],
			label: "Floor 5",
			borderColor: "#FF007F",
			fill: false
			}, { 
			data: [265,170,128,144,422,76,138,103,100,134],
			label: "Online",
			borderColor: "#FFFF00",
			fill: false
			}
	]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero:true
				}
			}]
		}
	}
});
</script>


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

<br>
<br>

