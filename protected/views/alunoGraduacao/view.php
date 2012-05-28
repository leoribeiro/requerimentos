<h1>View AlunoGraduacao #<?php echo $model->CDAlunoGraduacao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAlunoGraduacao',
		'Aluno_CDAluno',
		'CursoGraduacao_CDCurso',
	),
)); ?>
