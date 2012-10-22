<?php
$this->breadcrumbs=array(
	'Empresas'=>array('index'),
	$model->CDEmpresa=>array('view','id'=>$model->CDEmpresa),
	'Update',
);

$this->menu=array(
	array('label'=>'List Empresa', 'url'=>array('index')),
	array('label'=>'Create Empresa', 'url'=>array('create')),
	array('label'=>'View Empresa', 'url'=>array('view', 'id'=>$model->CDEmpresa)),
	array('label'=>'Manage Empresa', 'url'=>array('admin')),
);
?>

<h1>Update Empresa <?php echo $model->CDEmpresa; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>