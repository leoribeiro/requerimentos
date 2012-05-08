<?php
$this->breadcrumbs=array(
	'Ss  Requerimentos'=>array('index'),
	$model->CDRequerimento,
);

$this->menu=array(
	array('label'=>'List SS_Requerimento', 'url'=>array('index')),
	array('label'=>'Create SS_Requerimento', 'url'=>array('create')),
	array('label'=>'Update SS_Requerimento', 'url'=>array('update', 'id'=>$model->CDRequerimento)),
	array('label'=>'Delete SS_Requerimento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDRequerimento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SS_Requerimento', 'url'=>array('admin')),
);
?>

<h1>View SS_Requerimento #<?php echo $model->CDRequerimento; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDRequerimento',
		'SS_ModeloRequerimento_CDModeloRequerimento',
		'Aluno_CDAluno',
		'Observacoes',
	),
)); ?>
