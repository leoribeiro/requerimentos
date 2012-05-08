<?php
$this->breadcrumbs=array(
	'Ss  Opcaos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SS_Opcao', 'url'=>array('index')),
	array('label'=>'Manage SS_Opcao', 'url'=>array('admin')),
);
?>

<h1>Nova opção de modelo de requerimento</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>