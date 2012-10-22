<?php
$this->breadcrumbs=array(
	'Ss  Situacaos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SS_Situacao', 'url'=>array('index')),
	array('label'=>'Create SS_Situacao', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss--situacao-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Situações</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'SS_Situacao','descricao'=>'situação')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss--situacao-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDSituacao',
		'NMsituacao',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
