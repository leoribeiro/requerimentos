<?php
$this->breadcrumbs=array(
	'Curso Tecnicos'=>array('index'),
	$model->CDCurso=>array('view','id'=>$model->CDCurso),
	'Update',
);

$this->menu=array(
	array('label'=>'List CursoTecnico', 'url'=>array('index')),
	array('label'=>'Create CursoTecnico', 'url'=>array('create')),
	array('label'=>'View CursoTecnico', 'url'=>array('view', 'id'=>$model->CDCurso)),
	array('label'=>'Manage CursoTecnico', 'url'=>array('admin')),
);
?>

<h1>Alterar  Curso Técnico ID - <?php echo $model->CDCurso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>