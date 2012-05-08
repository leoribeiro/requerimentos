<?php
$this->breadcrumbs=array(
	'Curso Graduacaos'=>array('index'),
	$model->CDCurso,
);

$this->menu=array(
	array('label'=>'List CursoGraduacao', 'url'=>array('index')),
	array('label'=>'Create CursoGraduacao', 'url'=>array('create')),
	array('label'=>'Update CursoGraduacao', 'url'=>array('update', 'id'=>$model->CDCurso)),
	array('label'=>'Delete CursoGraduacao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDCurso),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CursoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Graduacao ID - <?php echo $model->CDCurso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDCurso',
		'NMCurso',
	),
)); ?>
