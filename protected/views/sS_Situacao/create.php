<?php
$this->breadcrumbs=array(
	'Situações'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SS_Situacao', 'url'=>array('index')),
	array('label'=>'Manage SS_Situacao', 'url'=>array('admin')),
);
?>

<h1>Nova situação</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>