<div id="titlePages">
<?
	if(Yii::app()->user->checkAccess('graduacao') || Yii::app()->user->checkAccess('tecnico')){
		echo "Meus Dados";

	}
	else{
		echo "Aluno ID - ".$model->CDAluno;
	}
?>
</div>
<br />
<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true,
        'fade'=>true,
        'closeText'=>'&times;',
        'alerts'=>array(
            'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
        ),
    )); ?>

<?php
	if(!is_null($modelGraduacao)){
		    $this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$model,
			'type'=>'striped bordered',
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
		    $this->widget('bootstrap.widgets.TbDetailView', array(
			'data'=>$model,
			'type'=>'striped bordered',
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
