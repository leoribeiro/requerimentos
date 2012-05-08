<?php
$this->breadcrumbs=array(
	'Aluno Tecnicos'=>array('index'),
	$model->CDAlunoTecnico,
);

$this->menu=array(
	array('label'=>'List AlunoTecnico', 'url'=>array('index')),
	array('label'=>'Create AlunoTecnico', 'url'=>array('create')),
	array('label'=>'Update AlunoTecnico', 'url'=>array('update', 'id'=>$model->CDAlunoTecnico)),
	array('label'=>'Delete AlunoTecnico', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDAlunoTecnico),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AlunoTecnico', 'url'=>array('admin')),
);
?>

<h1>View AlunoTecnico #<?php echo $model->CDAlunoTecnico; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAlunoTecnico',
		'Aluno_CDAluno',
		'CursoTecnico_CDCurso',
		'Serie',
	),
)); ?>
