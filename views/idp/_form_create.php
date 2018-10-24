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


<div class="row">
<?= $form->field($model, 'date_idp', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('date_idp')
    ],
    'template' => '<section class="col col-6"><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-phone"></i>{input}<b class="tooltip tooltip-top-right">กรอกเบอร์โทรศัพท์</b></label><em for="tel" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

<?= $form->field($model, 'num', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('num')
    ],
    'template' => '<section class="col col-6"><label class="label">{label}</label> <label class="input"> <i class="icon-append fa fa-phone"></i>{input}<b class="tooltip tooltip-top-right">กรอกเบอร์โทรศัพท์</b></label><em for="tel" class="invalid">{error}{hint}</em></section>'
    ])->label(false);
    ?>

</div>

 

<?= $form->field($model, 'comment', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('conment'),
        'rows'=>'5',
    ],
    'template' => '<section><label class="textarea">{label}<i class="icon-append fa fa-comment"></i>{input}<b class="tooltip tooltip-top-right">หมายเหตุ</b></label><em for="email" class="invalid">{error}{hint}</em></section>'
    ])->textarea()->label(false);
    ?>

<?= $form->field($model2, 'name_file', [
    'inputOptions' => [
        'placeholder' => $model->getAttributeLabel('name_file'),
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

<?php var_dump($model2)?>
<?php
$script = <<< JS
console.log(11);
$(document).ready(function() {	

});
JS;
$this->registerJs($script);
?>