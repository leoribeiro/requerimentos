<?php
$this->breadcrumbs=array(
	'Ss  Requerimentos',
);

$this->menu=array(
	array('label'=>'Create SS_Requerimento', 'url'=>array('create')),
	array('label'=>'Manage SS_Requerimento', 'url'=>array('admin')),
);
?>

<h1>Ss  Requerimentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
