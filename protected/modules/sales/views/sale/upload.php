<?php

/* @var $this SaleController */
/* @var $model Sale */

$this->breadcrumbs=array(
	'Sales'=>array('index'),
	'Upload',
);
?>

<div class="container">
            <div class="row">
             <div class="col-md-12 text-center"><h1>Visit My Blog www.hemant9807.blogspot.com</h1></div>
    <br>
                <div class="col-md-3 hidden-phone"></div>
                <div class="col-md-6" id="form-login">
                    <form class="well" action="import.php" method="post" name="upload_excel" enctype="multipart/form-data">
                        <fieldset>
                            <legend>Import CSV/Excel file</legend>
                            <div class="control-group">
                                <div class="control-label">
                                    <label>CSV/Excel File:</label>
                                </div>
                                <div class="controls form-group">
                                    <input type="file" name="file" id="file" class="input-large form-control">
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <div class="controls">
                                <button type="submit" id="submit" name="Import" class="btn btn-success btn-flat btn-lg pull-right button-loading" data-loading-text="Loading...">Upload</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="col-md-3 hidden-phone"></div>
            </div>
            
    
            <table class="table table-bordered">
                <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Address</th>
                        </tr> 
                      </thead>
                <?php
//                    $SQLSELECT = "SELECT * FROM subject ";
//                    $result_set =  mysql_query($SQLSELECT, $conn);
//                    while($row = mysql_fetch_array($result_set))
//                    {
                    ?>
<!--                        <tr>
                            <td><?php // echo $row['SUBJ_ID']; ?></td>
                            <td><?php // echo $row['SUBJ_CODE']; ?></td>
                            <td><?php // echo $row['SUBJ_DESCRIPTION']; ?></td>
                            <td><?php // echo $row['UNIT']; ?></td>
                            <td><?php // echo $row['SEMESTER']; ?></td>
                        </tr>-->
                    <?php
//                    }
                ?>
            </table>
        </div>



<script>
    var salesListReqUrl = '<?php print Yii::app()->createUrl('sales/sale/admin') ?>';	
    var salesViewReqUrl = '<?php print Yii::app()->createUrl('sales/sale/view') ?>';
</script>
