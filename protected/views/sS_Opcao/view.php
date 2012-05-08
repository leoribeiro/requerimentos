<?php
$this->breadcrumbs=array(
	'Ss  Opcaos'=>array('index'),
	$model->CDOpcao,
);

$this->menu=array(
	array('label'=>'List SS_Opcao', 'url'=>array('index')),
	array('label'=>'Create SS_Opcao', 'url'=>array('create')),
	array('label'=>'Update SS_Opcao', 'url'=>array('update', 'id'=>$model->CDOpcao)),
	array('label'=>'Delete SS_Opcao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDOpcao),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SS_Opcao', 'url'=>array('admin')),
);
?>

<h1>Opção ID - <?php echo $model->CDOpcao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDOpcao',
		'NMOpcao',
	),
)); 
?>
