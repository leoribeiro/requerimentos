<?php

$this->menu=array(
	array('label'=>'List Aluno', 'url'=>array('index')),
	array('label'=>'Create Aluno', 'url'=>array('create')),
	array('label'=>'Update Aluno', 'url'=>array('update', 'id'=>$model->CDAluno)),
	array('label'=>'Delete Aluno', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDAluno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Aluno', 'url'=>array('admin')),
);
?>
<?
	if(is_null(Yii::app()->user->getModelAluno())){
		echo "<h1>Aluno ID - ".$model->CDAluno."</h1>";
	}
	else{
		echo "<h1>Meus Dados</h1>";
	}
	
	echo "<br />";
	
	if(isset($_GET['saveSuccess']))
		echo "<div class='flash-success'>Dados alterados com sucesso.</div>";
?>


<?php 
	if(!is_null($modelGraduacao)){
		    $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
			'attributes'=>array(
				'NMAluno',
				'NumMatricula',
				'Bairro',
				'CEP',
				'EnderecoRua',
				'EnderecoNumero',
				'Email',
				'Telefone',
				'DataNascimento',
				'Sexo',
				array(
					'label'=>'Curso',
					'value'=>$modelGraduacao->relCurso->NMCurso,
					'filter'=>false,
				),
				array(
					'label'=>'Período',
					'value'=>$modelGraduacao->Periodo,
					'filter'=>false,
				),
			),
		));		
		$urlAluno = "alunoGraduacao";
		$id = $modelGraduacao->CDAlunoGraduacao;
	}
	else if(!is_null($modelTecnico)){
		    $this->widget('zii.widgets.CDetailView', array(
			'data'=>$model,
			'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
			'attributes'=>array(
				'NMAluno',
				'NumMatricula',
				'Bairro',
				'CEP',
				'EnderecoRua',
				'EnderecoNumero',
				'Email',
				'Telefone',
				'DataNascimento',
				'Sexo',
				array(
					'label'=>'Curso',
					'value'=>$modelTecnico->relCurso->NMCurso,
					'filter'=>false,
				),
				array(
					'label'=>'Série',
					'value'=>$modelTecnico->Serie,
					'filter'=>false,
				),
				array(
					'label'=>'Turma',
					'value'=>$modelTecnico->relTurma->NMTurma,
					'filter'=>false,
				),
			),
		));
		$urlAluno = "alunoTecnico";
		$id = $modelTecnico->CDAlunoTecnico;
	}



?>
	<br />
	<br />
	<div class="buttons">
		<a href="<? echo Yii::app()->createUrl($urlAluno.'/update',array('id'=>$id)); ?>" >
		    <img src="<? echo $this->createUrl('images/add.png'); ?>" alt=""/> 
		    Atualizar meus dados
		</a>
	</div>
