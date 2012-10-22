<?php
$this->breadcrumbs=array(
	'Ss  Requerimentos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SS_Requerimento', 'url'=>array('index')),
	array('label'=>'Manage SS_Requerimento', 'url'=>array('admin')),
);
?>

<h1>Cadastrar novo requerimento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>