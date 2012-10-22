<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss-requerimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


