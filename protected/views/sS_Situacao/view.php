<?php
$this->breadcrumbs=array(
	'Ss  Situacaos'=>array('index'),
	$model->CDSituacao,
);

$this->menu=array(
	array('label'=>'List SS_Situacao', 'url'=>array('index')),
	array('label'=>'Create SS_Situacao', 'url'=>array('create')),
	array('label'=>'Update SS_Situacao', 'url'=>array('update', 'id'=>$model->CDSituacao)),
	array('label'=>'Delete SS_Situacao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDSituacao),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SS_Situacao', 'url'=>array('admin')),
);
?>

<h1>Situação #<?php echo $model->CDSituacao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDSituacao',
		'NMsituacao',
	),
)); ?>
