<?php
$this->breadcrumbs=array(
	'Curso Tecnicos'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'List CursoTecnico', 'url'=>array('index')),
	array('label'=>'Create CursoTecnico', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('curso-tecnico-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cursos Tecnicos</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'cursoTecnico','descricao'=>'curso técnico')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'curso-tecnico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDCurso',
		'NMCurso',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
