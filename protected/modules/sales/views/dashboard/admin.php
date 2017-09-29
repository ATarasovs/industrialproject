<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print">

<script>
//Local storage items
var quickViews = JSON.parse(localStorage.getItem("quickViews"));
var lineView = [];
</script>

<?php
	$hasQuickview = false;
    // Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(Yii::getPathOfAlias('application.modules.sales.assets.js').'\sales-list.js'), CClientScript::POS_HEAD);



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

//$this->pageTitle=Yii::app()->name;

$this->pageTitle=Yii::app()->baseUrl;

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
	<button class="btn btn-primary btn-lg" onclick ="SmoothScrollToSummary()"><i class="fa fa-pie-chart" aria-hidden="true"></i> Summary Data</button>
	<button class="btn btn-primary btn-lg" onclick ="SmoothScrollToSummary()"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Average Transaction Spend</button>
    <button class="btn btn-primary btn-lg" onclick="SmoothScrollToSales()"><i class="fa fa-line-chart" aria-hidden="true"></i> Sales Data Viewer</button>
	<!-- <button class="btn btn-success" onclick ="generatePatternsArr();"><i class="fa fa-low-vision" aria-hidden="true"></i> Enable Accessibility Mode</button> -->
	<button class="btn btn-success btn-lg" onclick ="generatePatternsArr();" id="accessButton"><i class="fa fa-low-vision" aria-hidden="true"></i> Enable Colour Deficiency Mode</button>
	<br><br>
  </div>
  <!-- <div class="card-footer text-muted" style="background: #153465!important;">
    -
  </div> -->
</div>
<br>

<!-- 3 TOP CARDS -->
<div class="row">
	<div class="col-md-4">
		<div class="card text-center">
		<!-- <div class="card-header bg-primary" style="background: #153465!important;">
			<h4> <p class="text-white"></p> </h4>
		</div> -->
			<div class="card-block bg-info">
			<h3 class="card-title">Total Sales</h3>
			<div id="totalSalesCard">  <div id="totalSalesCardLoader"> </div><h2></h2> </div>
			<p class="card-text">Use the buttons below to navigate to different analytics</p>
				<button id='totalSalesCurrentMonth' class="btn btn-primary active" onclick="LoadTotalSalesCard(4)">Current Month</button>
				<button id='totalSalesCurrentQuarter' class="btn btn-primary" onclick="LoadTotalSalesCard(12)">Current Quarter</button>
			</div>
		</div>
	</div>

	<div class="col-md-4">
	<div class="card text-center">
	<!-- <div class="card-header bg-primary" style="background: #153465!important;">
			<h4> <p class="text-white"></p> </h4>
		</div> -->
		<div class="card-block bg-info">
		<h3 class="card-title">Active UoD Yoyo Users</h3>
		<div id="totalUsersCard">  <div id="totalUsersCardLoader"> </div><h2></h2> </div>
		<p class="card-text">Use the buttons below to navigate to different analytics</p>
			<button id ='totalUsersCurrentQuarter' class="btn btn-primary active" onclick="LoadActiveYoYoUsers(8)">Refresh</button>
		</div>
	</div>
</div>

<div class="col-md-4">
<div class="card text-center">
	<!-- <div class="card-header bg-primary" style="background: #153465!important;">
		<h4> <p class="text-white"></p> </h4>
	</div> -->
	<div class="card-block bg-info">
	<h3 class="card-title">Average # Daily Transactions</h3>
	<div id="averageTransCard"> <div id="averageTransLoader"> </div><h2> </h2> </div>
	<p class="card-text">Use the buttons below to navigate to different analytics</p>
		<button id='averageTransCurrentMonth' class="btn btn-primary" onclick="LoadAverageTrans(4)">Current Month</button>
		<button id='averageTransCurrentQuarter' class="btn btn-primary active" onclick="LoadAverageTrans(18)">Current Quarter</button>
	</div>
</div>
</div>


</div>


<!-- FIRST AND SECOND CARDS WITH SUMMARY OF WEEKLY SALES DATA -->	
  <div class="row">
    <div class="col-md-5">
  	<br>
					<div id="salesDiv"></div>
		<div class="card"> <!-- FIRST CARD WITH DOUGHNUT -->
			<h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white"><i class="fa fa-pie-chart" aria-hidden="true"></i> Sales Summary Data</p></h4>
			<div class="card-block">
				<div class="dropdown pull-right">
					<button class="btn btn-secondary dropdown-toggle D pull-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Select Data
					</button>
					<div class="dropdown-menu pull" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item pull-right" onClick="LoadDougnutData(1);" >Weekly data</a>
								<a class="dropdown-item pull-right" onClick="LoadDougnutData(4);" >Monthly data</a>
								<a class="dropdown-item pull-right" onClick="LoadDougnutData(12);" >Quarterly data</a>
					</div>
				</div>

				<br>
				<canvas id="myDoughnutChart" width="425" height="425"> </canvas>
				<hr>
					<h6>Quick views:</h6>
						<div class="mmenu">
							<button id="Shops" type="button" value="Shops" class="btn btn-primary" onclick="clearDoughnutView(1)"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Shops</button>
							<button id="Nightlife" type="button" value="Nightlife" class="btn btn-primary"  onclick="clearDoughnutView(2)"><i class="fa fa-glass" aria-hidden="true"></i> Nightlife</button>
							<button id="Services" type="button" value="Services" class="btn btn-primary"  onclick="clearDoughnutView(3)"><i class="fa fa-wrench" aria-hidden="true"></i> Services</button>

							<!-- <input id="New" type="button" value="New" class="btn btn-success"/> -->
							<input id="Reset" type="button" value="Reset" class="btn btn-danger pull-right" onclick="doughnutReset()"/>
							</span>
						</div>
						<br>
			</div>
		</div>
	</div>	
    <div class="col-sm-7">
	<br>
		<div class="card"> <!-- SECOND CARD WITH UNSUSED CHART -->
		<h4 class="card-header bg-primary" style="background: #153465!important;"><p class="text-white"><i class="fa fa-credit-card" aria-hidden="true"></i> Average User Transaction Spend</p></h4>
			<div class="card-block">
			<br><br>
					<canvas id="myBarChart" width="250" height="210"> </canvas>	
			</div>
		</div>
	</div>
	</div>
	
</div>
<br>
<!-- THIRD CARD WITH DETAILED WEEKLY SALES DATA -->
<div id="startOfSales"> </div> <!-- used for smooth scroll -->
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
		<button class="btn btn-danger" id="clearFilters" type="submit" value="Clear Filters" onClick=" ClearLineFilters()">Clear Filters</button> &nbsp;
	</div>
	<!-- FILTERS HIDDEN DIV -->
	<div id="filtersDiv"  style="display:none;" class="pull-left" >
	<div class="form-inline">
	
		<button type="button" name="answer" class="btn btn-danger pull-right" id="filtersButton" onclick="hideDiv()"><i class="fa fa-minus-square" aria-hidden="true"></i> Hide Filters</button>&nbsp; 

		<!-- Time to/from -->
		<input id="filterByTimeTo" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time: From">&nbsp;
		<input id="filterByTimeFrom" type="text" class="form-control filterInput" id="inlineFormInput" placeholder="Time: To">&nbsp;

		<!-- FROM/TO WEEKDAY -->
		<div class="dropdown pull-right"> &nbsp;
			<button class="btn btn-secondary dropdown-toggle weekdayFromL pull-right" type="button" id="filterByWeekdayFrom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="weekdayFromL">
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
			<button class="btn btn-secondary dropdown-toggle weekdayToL pull-right" type="button" id="filterByWeekdayTo" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="weekdayToL"> 
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
		<h5>To disable outlet views, simply click on any of the text items below* <h5>
		<canvas id="myChart" width="300" height="100"></canvas>
		
		<hr>
				<h6>Quick views:</h6>
				<div class="mmenuLine pull-left">
					<button id="ShopsLine" onclick="clearLineQuickView(1);" type="button" value="Shops" class="btn btn-primary"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Shops</button>
					<button id="NightlifeLine" onclick="clearLineQuickView(2);" type="button" value="Nightlife" class="btn btn-primary"><i class="fa fa-glass" aria-hidden="true"></i> Nightlife</button>
					<button id="Food" onclick="clearLineQuickView(3);" type="button" value="Food" class="btn btn-primary"><i class="fa fa-cutlery" aria-hidden="true"></i> Food</button>
					<button id="ServicesLine" onclick="clearLineQuickView(4);" type="button" value="Services" class="btn btn-primary"><i class="fa fa-wrench" aria-hidden="true"></i> Services</button> &nbsp;
					<button id="ResetLine" onclick="clearLineQuickView(5);" type="button" value="Reset" class="btn btn-danger pull-right"> Reset</button>
					<hr>
					<span id="userCreatedViews">

						
						</span>
						<span id="quickviewbutton" class="quickviews" style="display:inline;"><button id="New" value="New" class="btn btn-success" onclick="SetQuickView()" ><i class="fa fa-plus-circle" aria-hidden="true"></i>New Quickview</button> </span>
						<div id="quickviews" class="quickviews" style="display:none;">
						<br><br>
							<div class="input-group mb-2 mr-sm-2 mb-sm-0">
							<div class="input-group-addon"><i class="fa fa-font" aria-hidden="true"></i></i></div>
								<input type="text" class="form-control" id="quickViewName" placeholder="Quick View Name"></input> &nbsp; &nbsp;
								<br>
								<div class="input-group-addon"><i class="fa fa-comment" aria-hidden="true"></i></i></div>
								<input type="text" class="form-control" id="quickViewDescription" placeholder="Quick View Description"> </input> &nbsp; &nbsp;
								<br>
								<button id="New" value="New" class="btn btn-success" onclick="CreateQuickView()" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Save</button> &nbsp;
								<br> <br>
							</div>
						</div>
				</div>
  </div>
</div>

<!-- Back To Navigation Bar -->
<br>
<button class="btn btn-primary btn-block" onclick="SmoothScrollToNav()"> Back to navigation <i class="fa fa-arrow-up" aria-hidden="true"></i></button

<!-- Hidden Patterns For Graphs View -->
<div>
</div>
<img id="Pattern1" style="display:none;" src="http://0.gravatar.com/avatar/ca526952d47f85b2c6f4a4a953d92014?s=128&d=identicon&r=g"/>
<img id="Pattern2" style="display:none;" src="https://line25.com/wp-content/uploads/2015/12/It-a-Geometry-Shapes.jpg"/>
<img id="Pattern3" style="display:none;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSCFwJA04y4IYUBqD65E6mxEnRyazAj7F_ht197nbwGOC9g9Q8G"/>
<img id="Pattern4" style="display:none;" src="https://cms-assets.tutsplus.com/uploads/users/346/posts/27973/final_image/geometricpattern_final2.jpg"/>
<img id="Pattern5" style="display:none;" src="http://img.freepik.com/free-vector/minimal-rhombus-pattern-with-dots-and-lines_1159-2413.jpg?size=338&ext=jpg"/>
<img id="Pattern6" style="display:none;" src="https://s-media-cache-ak0.pinimg.com/originals/d7/22/51/d722517a3739dde7bbc46e299af58dcf.jpg"/>
<img id="Pattern7" style="display:none;" src="http://slodive.com/wp-content/uploads/2013/02/black-and-white-patterns/squared.jpg"/>
<img id="Pattern8" style="display:none;" src="http://colrd.com/misc/library/pattern/DinPattern/horton.gif"/>
<img id="Pattern9" style="display:none;" src="http://simple-repeat.com/img/jpgimg/grid2/grid680red256.jpg"/>
<img id="Pattern10" style="display:none;" src="http://4.bp.blogspot.com/-7vZF8swhwNs/U9-regTYTbI/AAAAAAAAAEs/PTca5aWvIFQ/s1600/pattern.jpg"/>
<img id="Pattern11" style="display:none;" src="http://blog.imagico.de/wp-content/uploads/2015/08/triangle1.png"/>
<img id="Pattern12" style="display:none;" src="http://lvlt.thesims3.com/sims3_asset/sims3_asset/thumb/shard000/000/063/152/06/original.jpg"/>
<img id="Pattern13" style="display:none;" src="http://www.allpsych.uni-giessen.de/kai/Fig3.jpg"/>
<img id="Pattern14" style="display:none;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ3MIHawv5CZ5mKIkxxGv-u4jfxlSY1GXTvCsSLg8cGe31oK1LiRA"/>
<img id="Pattern15" style="display:none;" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRz3O3ZpkfhvdMnZFEdyro2AM-bMsn9i7zwO_yIRNL6vq3iiRVG"/>

<br><br>

<!-- front end scripts  -->
<script>

function generatePatternsArr()
{
		
	window.accessEnable = !window.accessEnable;

	if(window.accessEnable == true){
		
		document.getElementById('accessButton').innerHTML = "<i class='fa fa-low-vision' aria-hidden='true'></i> Disable Colour Deficiency Mode";
		document.getElementById('accessButton').className = "btn btn-danger btn-lg";

	} else 
	{
		document.getElementById('accessButton').innerHTML = "<i class='fa fa-low-vision' aria-hidden='true'></i>Enable Colour Deficiency Mode";
		document.getElementById('accessButton').className = "btn btn-success btn-lg";
	}


	//Generate Patterns
	patternArr = [];

	// Create a temporary canvas and fill it with a grid pattern
	var patternCanvas = document.createElement("canvas"),
		patternContext = patternCanvas.getContext("2d");

	for(var i=0; i< 15; i++)
	{
		var img=document.getElementById("Pattern".concat(i+1));
		var pat=patternContext.createPattern(img,"repeat");
		patternContext.rect(0,0,10,10);
		patternContext.fillStyle=pat;
		patternContext.fill();

		patternArr[i] = pat;
	}


	//Store Original Background colours
	if(window.accessEnable == true)
	{
		origColoursArr = myDoughnutChart.data.datasets[0].backgroundColor;
		origStrokeArr = myDoughnutChart.data.datasets[0].fill; 
	}


	if(window.accessEnable ==true)
	{
		EnableAccessibility(patternArr, true);
	} else 
	{
		EnableAccessibility(origColoursArr, false);
	}

}

function EnableAccessibility(patternArr, access)
{

		//Doughnut
		myDoughnutChart.data.datasets[0].backgroundColor=patternArr;
		myDoughnutChart.data.datasets[0].hoverBackgroundColor=patternArr;
		if(access == true)
		{
		myDoughnutChart.data.datasets[0].borderColor= "#000000";
		myDoughnutChart.data.datasets[0].borderwidth = 3;
		} else if (access == false) 
		{
		myDoughnutChart.data.datasets[0].borderColor= "#ffffff";
		myDoughnutChart.data.datasets[0].borderwidth = 5;
		}
		myDoughnutChart.update();
		
		//Bar
		myBarChart.data.datasets[0].backgroundColor = patternArr[1];
		myBarChart.data.datasets[1].backgroundColor = patternArr[2];
		myBarChart.options.tooltips.displayColors = !myBarChart.options.tooltips.displayColors
		if(access == true)
		{
		myBarChart.data.datasets[0].borderColor= "#000000";
		myBarChart.data.datasets[0].borderwidth = 3;
		myBarChart.data.datasets[1].borderColor= "#000000";
		myBarChart.data.datasets[1].borderwidth = 3;
		} else if (access == false) 
		{
		myBarChart.data.datasets[0].borderColor= "#ffffff";
		myBarChart.data.datasets[0].borderwidth = 5;
		myBarChart.data.datasets[1].borderColor= "#ffffff";
		myBarChart.data.datasets[1].borderwidth = 5;
		}
		myBarChart.update();
	
	
		//Line
		for(var i=0; i<14; i++)
		{
			myChart.data.datasets[i].fill = !myChart.data.datasets[i].fill;
			myChart.data.datasets[i].backgroundColor =patternArr[i];
			myChart.data.datasets[i].borderColor =patternArr[i];
			myChart.options.tooltips.displayColors = !myChart.options.tooltips.displayColors;
	
		}
	
		myChart.update();


}


function showDiv() {
   document.getElementById('filtersDiv').style.display = "inline";
   document.getElementById('noFiltersDiv').style.display = "none";
   //document.getElementById('filtersButton').val("Hide advanced filters");
};

function hideDiv(){
	document.getElementById('filtersDiv').style.display = "none";
   document.getElementById('noFiltersDiv').style.display = "inline";

};

function ClearLineFilters()
{
	document.getElementById('filterByDateFrom').value = "";
	document.getElementById('filterByDateTo').value = "";
	document.getElementById('filterByTimeFrom').value = "";
	document.getElementById('filterByTimeTo').value = "";

};

function SmoothScrollToSales()
{
	$('html, body').animate({
        scrollTop: $("#startOfSales").offset().top
    }, 2000);

}

function SmoothScrollToNav()
{
	$('html, body').animate({
        scrollTop: $("#navtop").offset().top
    }, 2000);

}


function SmoothScrollToSummary()
{
	$('html, body').animate({
        scrollTop: $("#salesDiv").offset().top
    }, 2000);

}

function SmoothScrollToCreateView()
{
	$('html, body').animate({
        scrollTop: $("#myChart").offset().top
    }, 2000);

}

</script>

<script>


//Function for saving selected and deslected datasets
function AddItemQuickView(val)
{
	//if lineview doesnt contain val

	if($.inArray(val, window.lineView) == -1)
	{
		window.lineView[window.lineView.length] = val;
	} else 
	{
		window.lineView.splice( $.inArray(val, window.lineView), 1 );

	}

	//else remove val
};

//Function which generates string of selected chart data sets
//quickviews3 = local storage key
//lineView = global js array which stores selecte values
function CreateQuickView()
{
	var views = new Array();
	var timeFrom = $('#filterByTimeFrom').val();
	var timeTo = $('#filterByTimeTo').val();

	var weekdayFrom = $('#filterByWeekdayFrom').val();
	var weekdayTo = $('#filterByWeekdayTo').val();

	var dateFrom = $('#filterByDateFrom').val();
	var dateTo = $('#filterByDateTo').val();

	//Get filter options
	//Get user id
	var viewName = document.getElementById('quickViewName').value;
	var viewDescription = document.getElementById('quickViewDescription').value;
	views[views.length] = window.lineView;


	if(window.lineView.length < 1)
	{
		alert("No filters selected");
		return;
	}

	console.log("POST VIEW" + views, weekdayFrom, weekdayTo, timeFrom, timeTo);

	views = JSON.stringify(views);
		

	//AJAX CALL
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/SaveQuickView',
                type: "POST",
                data: {ViewName: viewName, ViewDescription: viewDescription, Selected: views, WeekdayFrom: weekdayFrom, WeekdayTo: weekdayTo, TimeFrom: timeFrom, TimeTo: timeTo, DateFrom: dateFrom, DateTo: dateTo},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						
					
						

                    }
                });



	document.getElementById('quickviews').style.display = "none";

	document.getElementById('quickviewbutton').style.display = "inline";

	CreateQuickViewButtons();

	return;

}

//Function which shows/hides the quick view creator
function SetQuickView()
{
	Reset();

	SmoothScrollToCreateView();

	document.getElementById('quickviews').style.display = "inline";

	document.getElementById('quickviewbutton').style.display = "none";

};

//Function which retrieves quickviews item and 
function CreateQuickViewButtons()
{
	//AJAX CALL TO GET USER CREATED VIEWS
	//AJAX CALL
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/RetrieveQuickViews',
                type: "GET",
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						//Assign Data to Chart

						console.log("RESP LEN: " + resp.length);
						var responseArr = [];
						for(var i=0; i<resp.length; i++)
						{
						 responseArr[responseArr.length] = $.map(resp[i], function(el) { return el });
						}

						 var respArr = responseArr;

						$("#userCreatedViews").html("");
						


						for(var i=0; i<respArr.length; i++)
						{	
							console.log(resp[i]);
							let button = document.createElement("button");
							button.className = "btn btn-info"
							button.innerHTML = respArr[i][2];		//assign button quick view name
							button.value = respArr[i][3];		//assign button selected/deselected item string
							button.title = respArr[i][8];
							button.id = "user-view-btn";

							let buttonLoc = document.getElementById('userCreatedViews');	//Add button to location
							//buttonLoc.append(button);
							$(buttonLoc).prepend(button);
							$(buttonLoc).prepend(' ');
							//buttonLoc.append(' ');

							let jsonString = respArr[i][3];
							let restOfObj = resp[i];

							button.addEventListener ("click", function() {
								ApplyViewButton(jsonString, restOfObj);
							});

							
						}
                    }
                });
	




}



//Function which inits the dashboard 
window.onload = function InitDashboard()
{
	window.accessEnable = true;
	origColoursArr = myDoughnutChart.data.datasets[0].backgroundColor;
	origStrokeArr = myDoughnutChart.data.datasets[0].fill; 
	generatePatternsArr();
		

	//Init Top 3 Cards
	LoadTotalSalesCard(4); //Calls load active users which calls load daily transactions (to avoid animation errors)
	LoadActiveYoYoUsers();
	LoadAverageTrans(18);

	//Init DoughnutChart with monthly data
	LoadDougnutData(4);

	//init avergae spend
	LoadAverageSpendData();

	//Init line graph with most recent week of data (minus one month right now so daata shows)
	var today = new Date();
	var mm = today.getFullYear()+'-'+'0'+(today.getMonth())+'-'+today.getDate();
	var dd = today.getFullYear()+'-'+'0'+(today.getMonth())+'-'+(today.getDate()-6);
	LoadLineChartData(7, dd, mm);

	document.getElementById('filterByDateFrom').value = (dd);
	document.getElementById('filterByDateTo').value = (mm);

	//Init user created quick views
	CreateQuickViewButtons();
	

};

//Loads SAles card data for a given time period
function LoadTotalSalesCard(length)
{
	document.getElementById('totalSalesCardLoader').innerHTML = '<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>'; 

	if(length > 4)
	{
		document.getElementById('totalSalesCurrentMonth').className = "btn btn-primary";
		document.getElementById('totalSalesCurrentQuarter').className = "btn btn-primary active";
	} else 
	{
		document.getElementById('totalSalesCurrentMonth').className = "btn btn-primary active";
		document.getElementById('totalSalesCurrentQuarter').className = "btn btn-primary";
	}

	var a = length; 
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/LoadTotalSales',
                type: "POST",
                data: {Weeks: a},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						
						//keep adding response to total until total = resp
						let saleslbl = $("#totalSalesCard h2").html();
						saleslbl = saleslbl.replace("£", "");
						saleslbl = saleslbl.replace(",","");
						//var int = parseInt(saleslbl);
							let $el = $("#totalSalesCard h2").html();
								let value = resp;
							
							document.getElementById('totalSalesCardLoader').innerHTML = ''; 
							
							$({percentage: 0}).stop(true).animate({percentage: value}, {
								duration : 4000,
								easing: "easeOutExpo",
								step: function () {
									// percentage with 1 decimal;
									let percentageVal = Math.round(this.percentage * 100) / 100;
									
									$("#totalSalesCard h2").text('£' + percentageVal);
								}
							}).promise().done(function () {
								// hard set the value after animation is done to be
								// sure the value is correct
								$("#totalSalesCard h2").text("£" + value);
							});


							

                    }
                });

}

function LoadAverageTrans(length)
{
	document.getElementById('averageTransLoader').innerHTML = '<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>'; 

	if(length > 4)
	{
		document.getElementById('averageTransCurrentMonth').className = "btn btn-primary";
		document.getElementById('averageTransCurrentQuarter').className = "btn btn-primary active";
	} else 
	{
		document.getElementById('averageTransCurrentMonth').className = "btn btn-primary active";
		document.getElementById('averageTransCurrentQuarter').className = "btn btn-primary";
	}

	var a=length;
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/LoadAvgDailyTransactions',
                type: "POST",
                data: {Weeks: a},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){

					console.log("###avg :" + resp );
						
						//keep adding response to total until total = resp
						let userslbl2 = $("#averageTransCard h2").html();
						//var int = parseInt(userslbl);
							let $el2 = $("#averageTranssCard h2").html();
								let value = resp;
							
								document.getElementById('averageTransLoader').innerHTML = ''; 
							
							$({percentage: 0}).stop(true).animate({percentage: value}, {
								duration : 4000,
								easing: "easeOutExpo",
								step: function () {
									// percentage with 1 decimal;
									let percentageVal2 = Math.round(this.percentage);
									
									$("#averageTransCard h2").text(percentageVal2);
								}
							}).promise().done(function () {
								// hard set the value after animation is done to be
								// sure the value is correct
								$("#averageTransCard h2").text(value);
							});


							//format into currency for lbl
						

                    }
                });

}

function LoadActiveYoYoUsers()
{
	document.getElementById('totalUsersCardLoader').innerHTML = '<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>'; 
	

	var a=1;
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/LoadActiveYoYoUsers',
                type: "POST",
                data: {Weeks: a},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						
						//keep adding response to total until total = resp
						let userslbl2 = $("#totalUsersCard h2").html();
						//var int = parseInt(userslbl);
							let $el2 = $("#totalUsersCard h2").html();
								let value = resp;
							
							//evt.preventDefault();
							document.getElementById('totalUsersCardLoader').innerHTML = ''; 
							
							$({percentage: 0}).stop(true).animate({percentage: value}, {
								duration : 4000,
								easing: "easeOutExpo",
								step: function () {
									// percentage with 1 decimal;
									let percentageVal2 = Math.round(this.percentage);
									
									$("#totalUsersCard h2").text(percentageVal2);
								}
							}).promise().done(function () {
								// hard set the value after animation is done to be
								// sure the value is correct
								$("#totalUsersCard h2").text(value);
							});


							//format into currency for lbl
						

                    }
                });

}

//Function which takes string of selected chart items hides/shows them.
function ApplyViewButton(values, obj)
{

	var valuesArr = $.map(obj, function(value, index) {
		return [value];
	});

	var result = values.slice(2, -2);

	var selectedArr = result.split(',').map(Number);

	for(var i=0; i<selectedArr.length; i++)
	{
		var arr = parseInt(selectedArr[i]);
		myChart.data.datasets[arr].hidden = !myChart.data.datasets[arr].hidden;
	}

	//filter day to and from
	if(valuesArr[4] != "")
	{
	weekdayDropdownFrom(valuesArr[4]);
	}
	if(valuesArr[5] != "")
	{
	weekdayDropdownTo(valuesArr[5]);
	}0

	if(valuesArr[6] != "00:00:00" && valuesArr[7] != "00:00:00")
	{
		//Filter time to and from
		if(valuesArr[6] != "")
		{
		document.getElementById('filterByTimeFrom').value = (valuesArr[6]);
		}
		if(valuesArr[7] != "")
		{
		document.getElementById('filterByTimeTo').value = (valuesArr[7]);
		}
	}

	if(valuesArr[8] != "")
	{
	document.getElementById('filterByDateFrom').value = (valuesArr[8]);
	}

	if(valuesArr[9] != "")
	{
	document.getElementById('filterByDateTo').value = (valuesArr[9]);
	}

	


	myChart.update();


}

//Clears user stored views
function ClearUserViews()
{




	//call function which deletes user created views

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
			fill: true
			}, { 
			data: [0,0,0,0,0,0,0],
			label: "Premier Shop",
			borderColor: "#0082c8",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "DJCAD Cantina",
			borderColor: "#f58231",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Library",
			borderColor: "#911eb4",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Ninewells Shop",
			borderColor: "#46f0f0",
			fill: true
			},{
			data: [0,0,0,0,0,0,0],
			label: "College Shop",
			borderColor: "#800000",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Mono",
			borderColor: "#d2f53c",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Liar Bar",
			borderColor: "#fabebe",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Air Bar",
			borderColor: "#008080",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Premier Shop - Yoyo Accept",
			borderColor: "#e6beff",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Level 2, Reception",
			borderColor: "#aa6e28",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Floor Five",
			borderColor: "#fffac8",
			fill: false
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Dental Café",
			borderColor: "#aaffc3",
			fill: true
			},{ 
			data: [0,0,0,0,0,0,0],
			label: "Food on Four",
			borderColor: "#000080",
			fill: true
			}, 
	]
	},
	options: {
		maintainAspectRatio: true,
		responsive: true,
		legend: {
					onClick: function (evt, item) {
					AddItemQuickView(item.datasetIndex);
					myChart.data.datasets[item.datasetIndex].hidden = !myChart.data.datasets[item.datasetIndex].hidden;
					myChart.update();
                	},
					labels:{
						fontSize: 16,

					},
					position: 'top',
				},
				tooltips: {
					callbacks: {
						label: function(tooltipItems, data) {
							return data.datasets[tooltipItems.datasetIndex].label +': ' + ' £' + tooltipItems.yLabel;
						}
					},
					bodyFontSize: 20,

			},
		elements: { point: { hitRadius: 12, hoverRadius: 7 } },
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
					labelString: "Time",
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
function clearDoughnutView(id)
{
	if(id==2)
	{
		doughnutReset();
		myDoughnutChart.getDatasetMeta(0).data[0].hidden = !myDoughnutChart.getDatasetMeta(0).data[0].hidden;
		myDoughnutChart.getDatasetMeta(0).data[1].hidden = !myDoughnutChart.getDatasetMeta(0).data[1].hidden;
		myDoughnutChart.getDatasetMeta(0).data[2].hidden = !myDoughnutChart.getDatasetMeta(0).data[2].hidden;
		myDoughnutChart.getDatasetMeta(0).data[3].hidden = !myDoughnutChart.getDatasetMeta(0).data[3].hidden;
		myDoughnutChart.getDatasetMeta(0).data[4].hidden = !myDoughnutChart.getDatasetMeta(0).data[4].hidden;
		myDoughnutChart.getDatasetMeta(0).data[5].hidden = !myDoughnutChart.getDatasetMeta(0).data[5].hidden;
		myDoughnutChart.getDatasetMeta(0).data[9].hidden = !myDoughnutChart.getDatasetMeta(0).data[9].hidden;
		myDoughnutChart.getDatasetMeta(0).data[12].hidden = !myDoughnutChart.getDatasetMeta(0).data[12].hidden;
		myDoughnutChart.getDatasetMeta(0).data[13].hidden = !myDoughnutChart.getDatasetMeta(0).data[13].hidden;
		myDoughnutChart.update();


	} else if (id ==1)
	{
		doughnutReset();
		myDoughnutChart.getDatasetMeta(0).data[0].hidden = !myDoughnutChart.getDatasetMeta(0).data[0].hidden;
		myDoughnutChart.getDatasetMeta(0).data[2].hidden = !myDoughnutChart.getDatasetMeta(0).data[2].hidden;
		myDoughnutChart.getDatasetMeta(0).data[3].hidden = !myDoughnutChart.getDatasetMeta(0).data[3].hidden;
		myDoughnutChart.getDatasetMeta(0).data[6].hidden = !myDoughnutChart.getDatasetMeta(0).data[6].hidden;
		myDoughnutChart.getDatasetMeta(0).data[7].hidden = !myDoughnutChart.getDatasetMeta(0).data[7].hidden;
		myDoughnutChart.getDatasetMeta(0).data[8].hidden = !myDoughnutChart.getDatasetMeta(0).data[8].hidden;
		myDoughnutChart.getDatasetMeta(0).data[10].hidden = !myDoughnutChart.getDatasetMeta(0).data[10].hidden;
		myDoughnutChart.getDatasetMeta(0).data[11].hidden = !myDoughnutChart.getDatasetMeta(0).data[11].hidden;
		myDoughnutChart.getDatasetMeta(0).data[12].hidden = !myDoughnutChart.getDatasetMeta(0).data[12].hidden;
		myDoughnutChart.getDatasetMeta(0).data[13].hidden = !myDoughnutChart.getDatasetMeta(0).data[13].hidden;
		myDoughnutChart.update();

	} else if (id == 3)
	{
		doughnutReset();
		myDoughnutChart.getDatasetMeta(0).data[1].hidden = !myDoughnutChart.getDatasetMeta(0).data[1].hidden;
		myDoughnutChart.getDatasetMeta(0).data[2].hidden = !myDoughnutChart.getDatasetMeta(0).data[2].hidden;
		myDoughnutChart.getDatasetMeta(0).data[4].hidden = !myDoughnutChart.getDatasetMeta(0).data[4].hidden;
		myDoughnutChart.getDatasetMeta(0).data[5].hidden = !myDoughnutChart.getDatasetMeta(0).data[5].hidden;
		myDoughnutChart.getDatasetMeta(0).data[6].hidden = !myDoughnutChart.getDatasetMeta(0).data[6].hidden;
		myDoughnutChart.getDatasetMeta(0).data[7].hidden = !myDoughnutChart.getDatasetMeta(0).data[7].hidden;
		myDoughnutChart.getDatasetMeta(0).data[8].hidden = !myDoughnutChart.getDatasetMeta(0).data[8].hidden;
		myDoughnutChart.getDatasetMeta(0).data[9].hidden = !myDoughnutChart.getDatasetMeta(0).data[9].hidden;
		myDoughnutChart.getDatasetMeta(0).data[10].hidden = !myDoughnutChart.getDatasetMeta(0).data[10].hidden;
		myDoughnutChart.getDatasetMeta(0).data[11].hidden = !myDoughnutChart.getDatasetMeta(0).data[11].hidden;
		myDoughnutChart.getDatasetMeta(0).data[12].hidden = !myDoughnutChart.getDatasetMeta(0).data[12].hidden;
		myDoughnutChart.getDatasetMeta(0).data[13].hidden = !myDoughnutChart.getDatasetMeta(0).data[13].hidden;
		myDoughnutChart.update();

	}
}

function doughnutReset()
{
		myDoughnutChart.getDatasetMeta(0).data[0].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[1].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[2].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[3].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[4].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[5].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[6].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[7].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[8].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[9].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[10].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[11].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[12].hidden = false;
		myDoughnutChart.getDatasetMeta(0).data[13].hidden = false;

		myDoughnutChart.update();

}

function clearLineQuickView(id)
{
        if ( id == 2 ) {
			//shops
			Reset();
						myChart.data.datasets[0].hidden = !myChart.data.datasets[0].hidden;
						myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
						myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
						myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
						myChart.data.datasets[4].hidden = !myChart.data.datasets[4].hidden;
						myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
						myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
						myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
						myChart.data.datasets[13].hidden = !myChart.data.datasets[13].hidden;

						myChart.update();

        } else if ( id == 1){

						Reset();	
			myChart.data.datasets[0].hidden = !myChart.data.datasets[0].hidden;
			myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
			myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
			myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
			myChart.data.datasets[7].hidden = !myChart.data.datasets[7].hidden;
			myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
			myChart.data.datasets[10].hidden = !myChart.data.datasets[10].hidden;
			myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
			myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
			myChart.data.datasets[13].hidden = !myChart.data.datasets[13].hidden;
			myChart.update();


				} else if ( id == 3){

					Reset();
					myChart.data.datasets[0].hidden = !myChart.data.datasets[0].hidden;
					myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
					myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
					myChart.data.datasets[4].hidden = !myChart.data.datasets[4].hidden;
					myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
					myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
					myChart.data.datasets[7].hidden = !myChart.data.datasets[7].hidden;
					myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
					myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
					myChart.data.datasets[10].hidden = !myChart.data.datasets[10].hidden;
					myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
					myChart.update();

				} else if (id == 4)
				{
					Reset();
					myChart.data.datasets[4].hidden = (!myChart.data.datasets[4].hidden);
					myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
					myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
					myChart.data.datasets[7].hidden = !myChart.data.datasets[7].hidden;
					myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
					myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
					myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
					myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
					myChart.data.datasets[10].hidden = !myChart.data.datasets[10].hidden;
					myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
					myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
					myChart.data.datasets[13].hidden = !myChart.data.datasets[13].hidden;
					myChart.update();

				} else if ( id == 5){

						Reset();

				}


}

function Reset(){

	window.lineView.length = 0;

	myChart.data.datasets.forEach((dataset) => {
							
		dataset.hidden = false;
							
	});

	myChart.update();

} 

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
 datasets: [
		 {
				 data: [0,0,0,0,0,0,0,0,0,0,0,0,0,0],
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
				 ],
				 borderWidth: 5,
				 borderColor: "#FFFFFF",

		 }]
},
		 options: {
				 responsive: true,
				 maintainAspectRatio: true,
				 tooltips: {
					bodyFontSize: 20,
					callbacks: {
						label: function(tooltipItem, data) {
							//get the concerned dataset
							var dataset = data.datasets[tooltipItem.datasetIndex];
							
							//Get label
							var lbl = data.labels[tooltipItem.index];

							if(lbl == "DUSA The Union - Marketplace")
							{
								lbl = "Marketplace";

							}

							//get the current items value
							var currentValue = dataset.data[tooltipItem.index];
					  
							return lbl + ": £" + currentValue;
						  }
					},
				 },
				 legend: {
						position: 'top',
						labels:{
						fontSize: 14,

					},
				},
				 elements: {
						 arc: {
								 borderColor: "#000000",
						 }
				 }, 
				 title: {
                display: true,
                text: 'Sales Data Summary'
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
		$(".btn.btn-secondary.dropdown-toggle.D").text("Weekly"); 
	} else if (length == 4)
	{
		$(".btn.btn-secondary.dropdown-toggle.D").text("Monthly"); 
	} else if (length == 12)
	{
		$(".btn.btn-secondary.dropdown-toggle.D").text("Quarterly"); 
	}


	var a = length; 
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/TestCall',
                type: "POST",
                data: {ajaxData: a},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
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

//Function which converts weekday drop down to weekday int
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


//Function which converts weekday drop down to weekday int
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

function LoadLineChartData(length, date, dateTo)
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

	if(date == null && dateTo == null)
	{
		//If date froom != null, pass that in also
		var date = $('#filterByDateFrom').val();
		var dateTo = $('#filterByDateTo').val();

	}


	var timeFrom = $('#filterByTimeFrom').val();
	var timeTo = $('#filterByTimeTo').val();

	var weekdayFrom = $('#filterByWeekdayFrom').val();
	var weekdayTo = $('#filterByWeekdayTo').val();
	console.log('time:' + timeFrom, timeTo)





	//Identifier for ajaxProcess function to load correct chartData
	var period = length;

	//Global varibale which stores 2d array of chart values
	var chartData;

	//AJAX call to siteController actionAjaxProcess
	jQuery.ajax({
	// The url must be appropriate for your configuration;
	// this works with the default config of 1.1.11
	url: 'index.php?r=sales/dashboard/LoadLineChartData',
	type: "POST",
	data: {Period: period, DateFrom: date, DateTo: dateTo, TimeFrom: timeFrom, TimeTo: timeTo, WeekdayFrom: weekdayFrom, WeekdayTo: weekdayTo},  
	error: function(xhr,tStatus,e){
				if(!xhr){
					alert(" We have an error ");
					alert(tStatus+"   "+e.message);
				}else{
						//alert("else: "+e.message); // the great unknown
				}
			},
			success: function(resp){

				console.log('###:' + resp);


				
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


				//Small function which adds prefix to a given date for chart label
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

				//Split date into just day
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

function clearLineQuickView(id)
{
        if ( id == 1 ) {
			//shops
						myChart.data.datasets[0].hidden = !myChart.data.datasets[0].hidden;
						myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
						myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
						myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
						myChart.data.datasets[4].hidden = !myChart.data.datasets[4].hidden;
						myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
						myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
						myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
						myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
						myChart.data.datasets[13].hidden = !myChart.data.datasets[13].hidden;

						myChart.update();

        } else if ( id == 2){

							
					myChart.data.datasets[0].hidden = (!myChart.data.datasets[0].hidden);
					myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
					myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
					myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
					myChart.data.datasets[4].hidden = !myChart.data.datasets[4].hidden;
					myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
					myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
					myChart.data.datasets[7].hidden = !myChart.data.datasets[7].hidden;
					myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
					myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
					myChart.update();


				} else if ( id == 3){

					myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
					myChart.data.datasets[4].hidden = !myChart.data.datasets[4].hidden;
					myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
					myChart.data.datasets[7].hidden = !myChart.data.datasets[7].hidden;
					myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
					myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
					myChart.data.datasets[10].hidden = !myChart.data.datasets[10].hidden;
					myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
					myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
					myChart.update();

				} else if (id == 4)
				{
					myChart.data.datasets[0].hidden = (!myChart.data.datasets[0].hidden);
					myChart.data.datasets[1].hidden = !myChart.data.datasets[1].hidden;
					myChart.data.datasets[2].hidden = !myChart.data.datasets[2].hidden;
					myChart.data.datasets[3].hidden = !myChart.data.datasets[3].hidden;
					myChart.data.datasets[5].hidden = !myChart.data.datasets[5].hidden;
					myChart.data.datasets[6].hidden = !myChart.data.datasets[6].hidden;
					myChart.data.datasets[8].hidden = !myChart.data.datasets[8].hidden;
					myChart.data.datasets[9].hidden = !myChart.data.datasets[9].hidden;
					myChart.data.datasets[10].hidden = !myChart.data.datasets[10].hidden;
					myChart.data.datasets[11].hidden = !myChart.data.datasets[11].hidden;
					myChart.data.datasets[12].hidden = !myChart.data.datasets[12].hidden;
					myChart.data.datasets[13].hidden = !myChart.data.datasets[13].hidden;
					myChart.update();

				} else if ( id == 5){

						Reset();

				}

				function Reset(){

					window.lineView.length = 0;

					myChart.data.datasets.forEach((dataset) => {
						
						dataset.hidden = false;
						
					});

					myChart.update();

				} 

}


</script> 

<!-- BAR CHART -->
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
			{
				label: "Current Month Average Transaction Spend £",
				backgroundColor: '#e6194b',
				fillColor: '#e6194b',
				highlightFill: '#e6194b',
				highlightStroke: '#e6194b',
				fontSize: 24,
				//data: [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
			},
			{
				label: "Previous Month Average Transaction Spend £",
				backgroundColor: '#3cb44b',
				fillColor: '#3cb44b',
				//data: [2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
			}  
			]
    },
    options: {
		tooltips: {
			bodyFontSize: 20,
		},
		legend: {
			position: 'top',
			labels:{
						fontSize: 16,

					},
		},
      title: {
        display: true,
        text: 'Sales totals Yoyo Wallet vs Other'
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


function LoadAverageSpendData()
{
	var currentMonth = new Date();
	var previousMonth = new Date();

	currentMonth.setMonth(currentMonth.getMonth()-3);		//loads average spend from 2 and 3 months ago (as there is no current data)
	previousMonth.setMonth(previousMonth.getMonth()-4);
	
	currentMonth = currentMonth.toISOString().split('T')[0];
	previousMonth = previousMonth.toISOString().split('T')[0];
	
	currentMonth = currentMonth.substring(0, currentMonth.length - 2);
	previousMonth = previousMonth.substring(0, previousMonth.length - 2);

	currentMonth = currentMonth.concat('00');
	previousMonth = previousMonth.concat('00');

	var a = currentMonth; 
	var b = previousMonth;
	jQuery.ajax({
                // The url must be appropriate for your configuration;
                // this works with the default config of 1.1.11
                url: 'index.php?r=sales/dashboard/LoadAverageData',
                type: "POST",
                data: {Month: a, PrevMonth: b},  
                error: function(xhr,tStatus,e){
                    if(!xhr){
                        alert(" We have an error ");
                        alert(tStatus+"   "+e.message);
                    }else{
                        //alert("else: "+e.message); // the great unknown
                    }
                    },
                success: function(resp){
						//Assign Data to Chart
						//alert(Object.keys(resp).length); 
						console.log("SUM DAT: " + JSON.stringify(resp));

						//Load Chart Data
						var counter = 0;
						myBarChart.data.datasets.forEach((dataset) => {
							dataset.data = resp[counter];
							counter ++;
						});

						myBarChart.update();



                    }
                });
}
</script>

<?php
}
?> 





