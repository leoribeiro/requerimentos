<?php
$this->breadcrumbs=array(
	'Ss  Modelo Requerimentos',
);

$this->menu=array(
	array('label'=>'Create SS_ModeloRequerimento', 'url'=>array('create')),
	array('label'=>'Manage SS_ModeloRequerimento', 'url'=>array('admin')),
);
?>

<h1>Ss  Modelo Requerimentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
