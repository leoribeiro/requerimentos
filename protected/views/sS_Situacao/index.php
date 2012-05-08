<?php
$this->breadcrumbs=array(
	'Ss  Situacaos',
);

$this->menu=array(
	array('label'=>'Create SS_Situacao', 'url'=>array('create')),
	array('label'=>'Manage SS_Situacao', 'url'=>array('admin')),
);
?>

<h1>Ss  Situacaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
