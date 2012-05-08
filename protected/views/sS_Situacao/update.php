<?php
$this->breadcrumbs=array(
	'Ss  Situacaos'=>array('index'),
	$model->CDSituacao=>array('view','id'=>$model->CDSituacao),
	'Update',
);

$this->menu=array(
	array('label'=>'List SS_Situacao', 'url'=>array('index')),
	array('label'=>'Create SS_Situacao', 'url'=>array('create')),
	array('label'=>'View SS_Situacao', 'url'=>array('view', 'id'=>$model->CDSituacao)),
	array('label'=>'Manage SS_Situacao', 'url'=>array('admin')),
);
?>

<h1>Update SS_Situacao <?php echo $model->CDSituacao; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>