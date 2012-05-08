<?php
$this->breadcrumbs=array(
	'Ss  Modelo Requerimentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SS_ModeloRequerimento', 'url'=>array('index')),
	array('label'=>'Manage SS_ModeloRequerimento', 'url'=>array('admin')),
);
?>

<h1>Cadastrar novo modelo de requerimento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>