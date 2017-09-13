<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to Dusa Analytics</h1>

<?php echo TbHtml::buttonDropdown('Weekly', array(
    array('label' => 'Weekly', 'url' => '#'),
    array('label' => 'Monthly', 'url' => '#'),
    array('label' => 'Yearly', 'url' => '#'),
    TbHtml::menuDivider(),
    array('label' => 'All-time', 'url' => '#'),
),	array('size'=>TbHtml::BUTTON_SIZE_LARGE, 'color' => TbHtml::BUTTON_COLOR_PRIMARY)); ?>

<?php
echo "<div class=\"myChart\">";
$this->widget(
	'chartjs.widgets.ChLine', 
	array(
		'width' => 1200,
		'height' => 600,
		'htmlOptions' => array(),
		'labels' => array("January","February","March","April","May","June"),
		'datasets' => array(
			array(
				"fillColor" =>"rgb(30,144,255)",
				"strokeColor" => "rgba(220,220,220,1)",
				"pointColor" => "rgba(220,220,220,1)",
				"pointStrokeColor" => "#ffffff",
				"data" => array(10, 20, 30, 25, $dataValue5, 10)
			),
			array(
				"fillColor" =>"rgb(255,165,0)",
				"strokeColor" => "rgba(220,220,220,1)",
				"pointColor" => "rgba(220,220,220,1)",
				"pointStrokeColor" => "#ffffff",
				"data" => array(5, 10, 25, 30, 35, 40)
			)      
		),
		'options' => array("datasetFill"=>"false")
	)
);
echo "</div>";
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
