<div style="margin-top:3%"class="container" align="center" >
    <div class="col-md-10" align="center">
        <div class="jumbotron centered" align="center">
          <h2 class=""><i class="fa fa-eye" aria-hidden="true"></i> View sale: <?php echo $model->sales_id; ?></h2>
          <br><br>
                   
          <?php $this->renderPartial('_view', array('model'=>$model)); ?>
        </div>
    </div>
</div>
