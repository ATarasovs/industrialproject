<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'upload-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
// ...
echo "<h1>";
echo $form->labelEx($model, 'file', array('class'=>'badge badge-primary') );
echo "</h1>";
echo $form->fileField($model, 'file');
echo $form->error($model, 'file');
// ...
echo CHtml::submitButton('Submit');
$this->endWidget();
?>

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