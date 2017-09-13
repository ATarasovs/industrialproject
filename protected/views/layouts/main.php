<?php 

Yii::app()->bootstrap->register(); 

##Global Library Includes
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/lib/chartJS/Chart.bundle.js'
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

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>	

<body>

<nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
<div class="container">
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#">Dusa Analytics</a>

<div class="collapse navbar-collapse" id="navbarsExampleDefault">
  <ul class="navbar-nav mr-auto">
	<li class="nav-item active">
	  <?php echo CHtml::link('Dashboard',array('/site/index', 'view'=>'about'), array('class'=>'nav-link')); ?> </a>
	</li>
	<li class="nav-item">
	<?php echo CHtml::link('About',array('#'), array('class'=>'nav-link')); ?>
	</li>
  <?php if (!Yii::app()->user->isGuest) { ?>
	<li class="nav-item dropdown">
	<a class="nav-link dropdown-toggle" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage Users </a>
	  <div class="dropdown-menu" aria-labelledby="dropdown01">
		<?php echo CHtml::link('View Users',array('/users/user'), array('class'=>'dropdown-item')); ?>
		<?php echo CHtml::link('Create User',array('/users/user/create'), array('class'=>'dropdown-item')); ?>
		<?php echo CHtml::link('About',array('/users/user/admin'), array('class'=>'dropdown-item')); ?>
	  </div>
	</li>
	<li class="nav-item">
	<?php echo CHtml::link('Upload',array('#'), array('class'=>'nav-link disabled')); ?>
	</li>
	</ul>
	<?php echo CHtml::link('Logout',array('/site/logout'), array('class'=>'btn btn-outline-danger my-2 my-sm-0')); ?>
<?php
} else { 
	?>
	</ul>
	<?php echo CHtml::link('Login',array('/site/login'), array('class'=>'btn btn-outline-success my-2 my-sm-0')); ?>

	<?php
	}
?>
</div>

</div>
</nav>
<br>
<br>


	
<div class="container">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Team 8<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->
</body>
</html>
