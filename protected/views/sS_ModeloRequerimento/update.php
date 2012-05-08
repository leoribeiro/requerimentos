<?php
$this->breadcrumbs=array(
	'Ss  Modelo Requerimentos'=>array('index'),
	$model->CDModeloRequerimento=>array('view','id'=>$model->CDModeloRequerimento),
	'Update',
);

$this->menu=array(
	array('label'=>'List SS_ModeloRequerimento', 'url'=>array('index')),
	array('label'=>'Create SS_ModeloRequerimento', 'url'=>array('create')),
	array('label'=>'View SS_ModeloRequerimento', 'url'=>array('view', 'id'=>$model->CDModeloRequerimento)),
	array('label'=>'Manage SS_ModeloRequerimento', 'url'=>array('admin')),
);
?>

<h1>Editar modelo de requerimento #<?php echo $model->CDModeloRequerimento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>