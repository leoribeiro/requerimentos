<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss--modelo-requerimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Permissão para Modelos de Requerimentos</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss-modelo-perm-requerimento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDModeloRequerimentoServidor',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
