<?php
/* @var $this SiteController */
Yii::app()->clientScript->registerCoreScript('jquery'); 
Yii::app()->clientScript->registerCoreScript('jquery.ui');

$this->pageTitle=Yii::app()->name;
?>

<?php if (Yii::app()->user->isGuest) { ?>

<?php $this->widget('bootstrap.widgets.TbHeroUnit', array(
    'heading' => 'Welcome to DUSA Analytics! ',
    'content' => '<p>To begin using the DUSA analytics dashboard, please login using the account details provided by your administrator.</p>' . TbHtml::button('Login', array('color' =>TbHtml::BUTTON_COLOR_PRIMARY, 'size' => TbHtml::BUTTON_SIZE_LARGE, 'onclick'=>"window.location='index.php?r=/site/login'")),
)); ?>

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
}
?>



<?php

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
