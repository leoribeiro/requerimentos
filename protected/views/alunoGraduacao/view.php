<div id="titlePages">Perfil - Aluno da graduação - <?php echo $model->relAluno->NumMatricula; ?></div>
<br />


<?php

if(!is_null($model->relAluno->relCidade)){
	$cidade = $model->relAluno->relCidade->NMCidade." - ".$model->relAluno->relCidade->relEstado->NMEstado;
}
else{
	$cidade = "";
}

    $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$model,
	'type'=>'striped bordered',
	'attributes'=>array(
		'relAluno.NMAluno',
		'relAluno.NumMatricula',
		'relCurso.NMCurso',
		'Periodo',
		'relAluno.Email',
		'relAluno.Telefone',
		'relAluno.DataNascimento',
		'relAluno.Sexo',
		'relAluno.NMMae',
		'relAluno.NMPai',
		'relAluno.CEP',
		'relAluno.EnderecoRua',
		'relAluno.EnderecoNumero',
		'relAluno.Bairro',
		array(
			'label'=>'Cidade',
			'value'=>$cidade,
			'filter'=>false,
		),
		

	),
)); ?>