<?php
$this->breadcrumbs=array(
	'Curso Graduacaos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List CursoGraduacao', 'url'=>array('index')),
	array('label'=>'Create CursoGraduacao', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('curso-graduacao-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Cursos de graduação</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'cursoGraduacao','descricao'=>'curso de graduação')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'curso-graduacao-grid',
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
