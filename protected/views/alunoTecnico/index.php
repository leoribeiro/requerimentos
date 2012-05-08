<?php
$this->breadcrumbs=array(
	'Aluno Tecnicos',
);

$this->menu=array(
	array('label'=>'Create AlunoTecnico', 'url'=>array('create')),
	array('label'=>'Manage AlunoTecnico', 'url'=>array('admin')),
);
?>

<h1>Aluno Tecnicos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
