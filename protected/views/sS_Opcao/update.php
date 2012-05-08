<?php
$this->breadcrumbs=array(
	'Ss  Opcaos'=>array('index'),
	$model->CDOpcao=>array('view','id'=>$model->CDOpcao),
	'Update',
);

$this->menu=array(
	array('label'=>'List SS_Opcao', 'url'=>array('index')),
	array('label'=>'Create SS_Opcao', 'url'=>array('create')),
	array('label'=>'View SS_Opcao', 'url'=>array('view', 'id'=>$model->CDOpcao)),
	array('label'=>'Manage SS_Opcao', 'url'=>array('admin')),
);
?>

<h1>Alterar Opção ID - <?php echo $model->CDOpcao; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>