<?php
$this->breadcrumbs=array(
	'Aluno Graduacaos'=>array('index'),
	$model->CDAlunoGraduacao,
);

$this->menu=array(
	array('label'=>'List AlunoGraduacao', 'url'=>array('index')),
	array('label'=>'Create AlunoGraduacao', 'url'=>array('create')),
	array('label'=>'Update AlunoGraduacao', 'url'=>array('update', 'id'=>$model->CDAlunoGraduacao)),
	array('label'=>'Delete AlunoGraduacao', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDAlunoGraduacao),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AlunoGraduacao', 'url'=>array('admin')),
);
?>

<h1>View AlunoGraduacao #<?php echo $model->CDAlunoGraduacao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAlunoGraduacao',
		'Aluno_CDAluno',
		'CursoGraduacao_CDCurso',
	),
)); ?>
