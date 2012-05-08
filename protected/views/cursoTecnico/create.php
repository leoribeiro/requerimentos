<?php
$this->breadcrumbs=array(
	'Curso Tecnicos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CursoTecnico', 'url'=>array('index')),
	array('label'=>'Manage CursoTecnico', 'url'=>array('admin')),
);
?>

<h1>Create CursoTecnico</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>