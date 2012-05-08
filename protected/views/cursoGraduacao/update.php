<?php
$this->breadcrumbs=array(
	'Curso Graduacaos'=>array('index'),
	$model->CDCurso=>array('view','id'=>$model->CDCurso),
	'Update',
);

$this->menu=array(
	array('label'=>'List CursoGraduacao', 'url'=>array('index')),
	array('label'=>'Create CursoGraduacao', 'url'=>array('create')),
	array('label'=>'View CursoGraduacao', 'url'=>array('view', 'id'=>$model->CDCurso)),
	array('label'=>'Manage CursoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Alterar graduação ID - <?php echo $model->CDCurso; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>