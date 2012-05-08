<?php
$this->breadcrumbs=array(
	'Aluno Graduacaos',
);

$this->menu=array(
	array('label'=>'Create AlunoGraduacao', 'url'=>array('create')),
	array('label'=>'Manage AlunoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Aluno Graduacaos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
