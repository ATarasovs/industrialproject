<?php
if(Yii::app()->user->hasFlash('success')) { ?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?> <br/>
        Are you sure you want to add this data to database?<br/>
        <button id="yesBtn">Yes</button>
        <button id="noBtn">No</button>
    </div>
<?php } else { ?>
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
echo $form->labelEx($model, 'file');
echo $form->fileField($model, 'file');
echo $form->error($model, 'file');
// ...
echo CHtml::submitButton('Submit');
$this->endWidget();
}
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