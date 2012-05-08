<?php
$this->breadcrumbs=array(
	'Ss  Requerimentos'=>array('index'),
	$model->CDRequerimento=>array('view','id'=>$model->CDRequerimento),
	'Update',
);

$this->menu=array(
	array('label'=>'List SS_Requerimento', 'url'=>array('index')),
	array('label'=>'Create SS_Requerimento', 'url'=>array('create')),
	array('label'=>'View SS_Requerimento', 'url'=>array('view', 'id'=>$model->CDRequerimento)),
	array('label'=>'Manage SS_Requerimento', 'url'=>array('admin')),
);
?>

<h1>Update SS_Requerimento <?php echo $model->CDRequerimento; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>