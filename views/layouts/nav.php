<?php
use yii\helpers\Html;

?>
  
    
<nav>
<?=\yii\widgets\Menu::widget([
'options' => ['class' => ''],
'items' => [

    [
		'label' => 'Dashboard',
		'url' => ['/site/index'],
		'template' => '<a href="{url}" title="{label}"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">{label}</span></a>',
		
	],
	[
		'label' => 'Contact',
		'url' => ['/co/index'],
		'template' => '<a href="{url}" title="{label}"><i class="fa fa-lg fa-fw fa-phone"></i> <span class="menu-item-parent">{label}</span></a>',
		
	],
    [
		'label' => 'Setting',  
		'url' => ['#'],
		'template' => '<a href="#" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
		'items' => [
            [
				'label' => 'Profile',
				'url' => ['/user/profile'],
				'template' => '<a href="{url}&id='.Yii::$app->user->id.'" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],
            [
				'label' => 'Uploads',
				'url' => ['/uploads/upload'],
				'template' => '<a href="{url}" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],
            [
				'label' => 'PhpmyAdmin',
				'url' => 'phpmyadmin',
				'template' => '<a target="_blank" href="http://'.$_SERVER["SERVER_NAME"].'/{url}" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],
			[
				'label' => 'SmartAdmin',
				'url' => 'html',
				'template' => '<a target="_blank" href="http://'.$_SERVER["SERVER_NAME"].'/{url}" title="{label}"><i class="fa fa-lg fa-fw fa-wrench"></i> <span class="menu-item-parent">{label}</span></a>',
			],
        ],
    ],
],
'submenuTemplate' => "\n<ul>\n{items}\n</ul>\n",
'encodeLabels' => false, //allows you to use html in labels
'activateParents' => true,   
]);  ?>
</nav>