<?php
$this->breadcrumbs=array(
	'Alunos',
);

$this->menu=array(
	array('label'=>'Create Aluno', 'url'=>array('create')),
	array('label'=>'Manage Aluno', 'url'=>array('admin')),
);
?>

<h1>Alunos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
