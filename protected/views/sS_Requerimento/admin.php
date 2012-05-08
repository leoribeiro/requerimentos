<?php
$this->breadcrumbs=array(
	'Ss  Requerimentos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SS_Requerimento', 'url'=>array('index')),
	array('label'=>'Create SS_Requerimento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss--requerimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Requerimentos Existentes</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'SS_Requerimento','descricao'=>'Requerimento')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss--requerimento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDRequerimento',
		'SS_ModeloRequerimento_CDModeloRequerimento',
		'Aluno_CDAluno',
		'Observacoes',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
