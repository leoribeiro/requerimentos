<fieldset>
<legend>Dados do Aluno</legend>
<?php
	$permC = false;
	$turma = null;
	if(!is_null($modelAlunoGraduacao)){
		$modelCurso = $modelAlunoGraduacao;
		$permC = false;
	}
	else if(!is_null($modelAlunoTecnico)){
		$modelCurso = $modelAlunoTecnico;
		$permC = true;
		$turma = $modelAlunoTecnico->relTurma->NMTurma;
	}

	if(!is_null($modelAluno->relCidade)){
		$cidade = $modelAluno->relCidade->NMCidade." - ".$modelAluno->relCidade->relEstado->NMEstado;
	}
	else{
		$cidade = "";
	}

	$this->widget('bootstrap.widgets.TbDetailView', array(
	'type'=>'striped bordered',
	'data'=>$modelAluno,
	'attributes'=>array(
		'NMAluno',
		'DataNascimento',
		'NumMatricula',
		array(
			'label'=>'Curso',
			'value'=>$modelCurso->relCurso->NMCurso,
			'filter'=>false,
		),
		array(
			'label'=>'Turma',
			'value'=>$turma,
			'filter'=>false,
			'visible'=>$permC,
		),
		'Email',
		'NMMae',
		'NMPai',
		'CEP',
		'Bairro',
		'EnderecoRua',
		'EnderecoNumero',
		array(
			'label'=>'Cidade',
			'value'=>$cidade,
			'filter'=>false,
		),


	),
));

if(Yii::app()->user->checkAccess('graduacao') || Yii::app()->user->checkAccess('tecnico')){
?>
<p align="right" class="note">Caso seus dados estejam incorretos, <? echo CHtml::link('atualize aqui',array('/aluno/view', 'id'=>Yii::app()->user->getModelAluno()->CDAluno)); ?>.</p>
</fieldset>
<?
}
?>