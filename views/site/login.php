<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
						
<?php 
$fieldOptions1 = [
    'options' => ['class' => ''],
    'inputTemplate' => "<label class=\"input\"><i class=\"icon-append fa fa-user\"></i>{input}\n<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-user txt-color-teal\"></i> Please enter email address/username</b><label>"
];

$fieldOptions2 = [
    //'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "<label class=\"input\"><i class=\"icon-append fa fa-lock\"></i>{input}\n<b class=\"tooltip tooltip-top-right\"><i class=\"fa fa-lock txt-color-teal\"></i> Please enter password</b><label>"
];


$form = ActiveForm::begin([
		'id' => 'login-form',
		'options' => ['class' => 'smart-form client-form'],
        //'layout' => 'horizontal',
        'fieldConfig' => [
            //'template' => "{label}{input}{error}",
            'template' => "{label}{input}{error}",
            'labelOptions' => ['class' => 'label'],
        ],
	]); 
?>
<?= Html::beginForm(['site/login', 'id' => 'login-form'], 'post', ['enctype' => 'multipart/form-data']) ?>
<header>Sign In</header>
	<fieldset>
		<section>
            <?= $form->field($model, 'username', $fieldOptions1)->textInput(['autofocus' => true,])?>
		</section>
		<section>
            <?= $form->field($model, 'password', $fieldOptions2)->passwordInput() ?>
		    <div class="note"><a href="forgotpassword.html">Forgot password?</a></div>
		</section>
		<div>
    If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
</div>
        <?= $form->field($model, 'rememberMe')->checkbox([
			'template' => "<section><label class=\"checkbox\">{input}<i></i>Remember Me</label></section>",	
		]) 
		?>
	</fieldset>
        <footer>
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>            
        </footer>

<?php ActiveForm::end(); ?>

<?php 
$this->registerJs( <<< EOT_JS_CODE

<script>
			runAllForms();

			$(function() {
				// Validation
				$("#login-form").validate({
					// Rules for form validation
					rules : {
						username : {
							required : true,
							//email : true
						},
						password : {
							required : true,
							minlength : 3,
							maxlength : 20
						}
					},

					// Messages for form validation
					messages : {
						username : {
							required : 'Please enter your email address',
							username : 'Please enter a VALID email address'
						},
						password : {
							required : 'Please enter your password'
						}
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					}
				});
			});
		</script>

EOT_JS_CODE
);
?>


