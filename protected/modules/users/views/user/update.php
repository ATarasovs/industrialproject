<div style="margin-top:3%"class="container" align="center" >
    <div class="col-md-10" align="center">
        <div class="jumbotron centered" align="center">
          <h2 class=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update user: <?php echo $model->username; ?></h2>
          <br><br>
                   
          <?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </div>
</div>
