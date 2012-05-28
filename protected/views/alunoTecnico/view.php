<h1>Aluno do técnico #<?php echo $model->CDAlunoTecnico; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAlunoTecnico',
		'Aluno_CDAluno',
		'CursoTecnico_CDCurso',
		'Serie',
	),
)); ?>
