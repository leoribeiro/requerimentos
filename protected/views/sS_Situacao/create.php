<?php
$this->breadcrumbs=array(
	'Ss  Situacaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SS_Situacao', 'url'=>array('index')),
	array('label'=>'Manage SS_Situacao', 'url'=>array('admin')),
);
?>

<h1>Create SS_Situacao</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>