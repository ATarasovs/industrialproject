<div class="jumbotron">
  <h2 class="display-3">File Upload</h2>
  <p class="lead">Adding data to the system is easy.</p>
  <hr class="my-4">
  <p>To add new data to the system, simply attach the xls file below and click upload! <br/><small>(Also you may use drag & drop function)</small></p>
  <p class="lead">
  <br><br>
    <?php
    $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'upload-form',
            'enableAjaxValidation' => false,
            'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )
    );
    // ..
    echo $form->fileField($model, 'file');
    echo $form->error($model, 'file');
    // ...
    echo CHtml::submitButton('Upload', array('class'=>'btn btn-primary'));
    $this->endWidget();
    ?>

  </p>
</div>



<script>
    var importExcelReqUrl = '<?php print Yii::app()->createUrl('sales/sale/importexcel') ?>';
    var uploadFileReqUrl = '<?php print Yii::app()->createUrl('uploadfiles/uploadfile/create') ?>';
    
    $(document).ready(function() {
        initButtons()
        
        function initButtons() {
            $( "#yesBtn" ).click(function() {
                location.href = importExcelReqUrl;
            });
            
            $( "#noBtn" ).click(function() {
                location.href = uploadFileReqUrl;
            });
        }
    });
</script>