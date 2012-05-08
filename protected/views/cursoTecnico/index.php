<?php
$this->breadcrumbs=array(
	'Curso Tecnicos',
);

$this->menu=array(
	array('label'=>'Create CursoTecnico', 'url'=>array('create')),
	array('label'=>'Manage CursoTecnico', 'url'=>array('admin')),
);
?>

<h1>Curso Tecnicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
