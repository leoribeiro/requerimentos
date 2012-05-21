<?php
$this->breadcrumbs=array(
	'Ss  Modelo Requerimentos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SS_ModeloRequerimento', 'url'=>array('index')),
	array('label'=>'Create SS_ModeloRequerimento', 'url'=>array('create')),
);

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

<h1>Modelos de Requerimentos</h1>


<? $this->renderPartial('/site/botoes',array('modelo'=>'SS_ModeloRequerimento','descricao'=>'modelo de requerimento')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss-modelo-requerimento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDModeloRequerimento',
		'NMModeloRequerimento',
		'SgRequerimento',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
