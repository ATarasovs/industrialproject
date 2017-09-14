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
	
	//Analytics Dashboard
	echo TbHtml::buttonDropdown('Weekly', array(
		array('label' => 'Weekly', 'url' => '#'),
		array('label' => 'Monthly', 'url' => '#'),
		array('label' => 'Yearly', 'url' => '#'),
		TbHtml::menuDivider(),
		array('label' => 'All-time', 'url' => '#'),
	),	array('size'=>TbHtml::BUTTON_SIZE_LARGE, 'color' => TbHtml::BUTTON_COLOR_PRIMARY));

	?>
	
	<canvas id="myChart" width="700" height="400"></canvas>
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
				data: [282,350,112,502,105,809,700],
				label: "Mono",
				borderColor: "#8e5ea2",
				fill: false
			  }, { 
				data: [765,70,378,190,42,276,408,123,400,34],
				label: "Union Shop",
				borderColor: "#3cba9f",
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

<?php
}
?>

<br>
<br>
<script>
document.write("jQuery version.."+$.fn.jquery);

$(function(){
    $('#btn').click(function() {
        $dataValue5 = 25;
		window.reload();
    });
});
</script>
