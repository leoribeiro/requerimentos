<?php
$this->breadcrumbs=array(
	'Ss  Opcaos',
);

$this->menu=array(
	array('label'=>'Create SS_Opcao', 'url'=>array('create')),
	array('label'=>'Manage SS_Opcao', 'url'=>array('admin')),
);
?>

<h1>Ss  Opcaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
