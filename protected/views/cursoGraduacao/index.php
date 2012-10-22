<?php
$this->breadcrumbs=array(
	'Curso Graduacaos',
);

$this->menu=array(
	array('label'=>'Create CursoGraduacao', 'url'=>array('create')),
	array('label'=>'Manage CursoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Curso Graduacaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
