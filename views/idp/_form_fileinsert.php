<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<?php    
   // print_r(explode(',',$model->tel));
?>

<?php 
    $form = ActiveForm::begin([
		'id' => 'contact-form',
		'options' => [
            'class' => 'smart-form',
            'novalidate'=>'novalidate',
            'enctype' => 'multipart/form-data'
        ],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}{input}{error}",
            'labelOptions' => ['class' => 'label'],
        ],
        'enableAjaxValidation' => true,
	]);  ?>


<fieldset> 
<div>
<?= $form->field($model, 'name', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('name')
    ],
    'template' => '<section class=""><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-user"></i>{input}<b class="tooltip tooltip-top-right">กรอกชื่อ</b></label><em for="name" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>


</div>    



</div>

 

<?= $form->field($model, 'comment', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('conment'),
        'rows'=>'5',
    ],
    'template' => '<section><label class="textarea">{label}<i class="icon-append fa fa-comment"></i>{input}<b class="tooltip tooltip-top-right">หมายเหตุ</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->textarea()->label(false);
    ?>


<fieldset class="text-right"> 
<?= Html::resetButton('Reset', ['class' => 'btn btn-warning btn-lg']) ?> <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-lg']) ?>
</fieldset> 
    <?php ActiveForm::end(); ?>

</fieldset>

<a herf= "#" id="fileinsertsave" class="btn btn-warning " data-id="1" < i class="fa fa-pencil-square-o"></i> เพิ่มไฟล์</a>


<?php var_dump($model2)?>
<?php
$script = <<< JS
   
$(document).ready(function() {	    

    var url_create = "index.php?r=idp/fileinsert";
    	$( "#fileinsertsave" ).click(function() {
        	$.get(url_create,function (data){
                $("#activity-modal").find(".modal-body").html(data);
                $(".modal-body").html(data);
                $(".modal-title").html("เพิ่มข้อมูล");
            	// $(".modal-footer").html(footer);
                $("#activity-modal").modal("show");
                //   $("#myModal").modal('toggle');
        	});     
		}); 
        
});
JS;
$this->registerJs($script);
?>