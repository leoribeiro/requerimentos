<?php
$this->breadcrumbs=array(
	'Curso Graduacaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CursoGraduacao', 'url'=>array('index')),
	array('label'=>'Manage CursoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Create CursoGraduacao</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>