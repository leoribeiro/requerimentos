<div class="wide form">

<fieldset>
<legend>Dados do Aluno</legend>
<?php 
	if(!is_null($modelAlunoGraduacao)){
		$modelCurso = $modelAlunoGraduacao;
	}
	else if(!is_null($modelAlunoTecnico)){
		$modelCurso = $modelAlunoTecnico;
	}

	if(!is_null($modelAluno->relCidade)){
		$cidade = $modelAluno->relCidade->NMCidade." - ".$modelAluno->relCidade->relEstado->NMEstado;
	}
	else{
		$cidade = "";
	}
	
	
	$this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelAluno,
	'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
	'attributes'=>array(
		'NMAluno',
		'NumMatricula',
		array(
			'label'=>'Curso',
			'value'=>$modelCurso->relCurso->NMCurso,
			'filter'=>false,
		),
		'Email',
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
	
)); ?>
</fieldset>


</div><!-- form -->