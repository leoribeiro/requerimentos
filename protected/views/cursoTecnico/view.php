<?php
$this->breadcrumbs=array(
	'Curso Tecnicos'=>array('index'),
	$model->CDCurso,
);

$this->menu=array(
	array('label'=>'List CursoTecnico', 'url'=>array('index')),
	array('label'=>'Create CursoTecnico', 'url'=>array('create')),
	array('label'=>'Update CursoTecnico', 'url'=>array('update', 'id'=>$model->CDCurso)),
	array('label'=>'Delete CursoTecnico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDCurso),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CursoTecnico', 'url'=>array('admin')),
);
?>

<h1>Curso Técnico ID - <?php echo $model->CDCurso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDCurso',
		'NMCurso',
	),
)); ?>
