<?php 

Yii::app()->bootstrap->register(); 

##Global Library Includes

#chart-js
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/lib/chartJS/Chart.bundle.js'
);

#font awesome
Yii::app()->clientScript->registerScriptFile(
	Yii::app()->baseUrl.'/lib/font-awesome-4.7.0/css/font-awesome.css'
);



?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="en">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection">
	<![endif]-->
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
	 -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
	<script src="https://unpkg.com/flatpickr"></script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<div id="navtop"> </div>
<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary" style="background: #153465!important;">

<div class="container">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<a class="navbar-brand" href="<?php echo Yii::app()->baseUrl ?>/index.php?r=sales/dashboard/admin"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dusa Analytics</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<div class="collapse navbar-collapse" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
	<li class="nav-item">
	<?php 
	echo CHtml::link('<i class="fa fa-line-chart"></i> Dashboard',array('/sales/dashboard/admin'), array('class'=>'nav-link')); 
	?>
	</li>
	<li class="nav-item">
	<?php 
	echo CHtml::link('<i class="fa fa-file-text-o" aria-hidden="true"></i> Sales',array('/sales/sale/admin'), array('class'=>'nav-link')); 
	?>
	</li>
  <?php if (!Yii::app()->user->isGuest) { ?>
	<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-users"></i> Manage Users </a>
	  <div class="dropdown-menu" aria-labelledby="dropdown01">
		<?php echo CHtml::link('<i class="fa fa-plus-circle"></i> Create User',array('/users/user/create'), array('class'=>'dropdown-item')); ?>
		<?php echo CHtml::link('<i class="fa fa-user-times"></i> Manage Users',array('/users/user/admin'), array('class'=>'dropdown-item')); ?>
	  </div>
	</li>
	<li class="nav-item">
	<?php echo CHtml::link('<i class="fa fa-cloud-upload"></i> Upload',array('/sales/sale/upload'), array('class'=>'nav-link')); ?>
	</li>
	</ul>
	<?php echo CHtml::link('<i class="fa fa-sign-out"></i> Logout',array('/site/logout'), array('class'=>'btn btn-danger my-2 my-sm-0')); ?>

<?php
} else { 
	?>
	</ul>
	<?php echo CHtml::link('<i class="fa fa-sign-in"></i> Login',array('/site/login'), array('class'=>'btn btn-success my-2 my-sm-0')); ?>
	<?php
	}
	?>
</div>

<script>
 $(window).load(function(){
      var url = window.location.href;
      $('nav li').find('.active').removeClass('active');
      $('nav li a').filter(function(){
          return this.href == url;
      }).parent().addClass('active');
  });
</script>

</div>
	<img src="https://www.yoyowallet.com/assets/img/logo.svg" class="pull right" width="200" onerror="this.src='your.png'">
</nav>
<br>
<br>
	
<div class="container" style="width:90%;">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<!--<div id="footer">
		Copyright &copy; <?php ##echo date('Y'); ?> Team 8<br/>
		All Rights Reserved.<br/>
	</div><!footer -->

</div><!-- page -->
</body>
</html>
