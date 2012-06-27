<h1>Perfil - Aluno da graduação - <?php echo $model->relAluno->NumMatricula; ?></h1>
<div class="buttons">
<a href="<? echo Yii::app()->createUrl('alunoGraduacao/create'); ?>" >
    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt="Novo Aluno"/> 
    Novo Aluno
</a>
<a href="<? echo Yii::app()->createUrl('alunoGraduacao/admin'); ?>" class="search-button" >
    <img src="<? echo $this->createUrl('images/c.png'); ?>" alt="Consultar Alunos de graduação"/> 
    Consultar Alunos de graduação
</a>
</div>
<br />
<br />
<br />


<?php 

if(!is_null($model->relAluno->relCidade)){
	$cidade = $model->relAluno->relCidade->NMCidade." - ".$model->relAluno->relCidade->relEstado->NMEstado;
}
else{
	$cidade = "";
}

    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAlunoGraduacao',
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