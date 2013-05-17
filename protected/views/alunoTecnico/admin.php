<div id="titlePages">
		Alunos de curso técnico
</div>

<div id="statusMsg"></div>

<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Novo aluno',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('alunoTecnico/create')
    ));

	$criteria = new CDbCriteria;
	$criteria->order = 'NMCurso';
	$modelCurso = CursoTecnico::model()->findAll($criteria);
	$dropCurso = CHtml::listData($modelCurso,'CDCurso','NMCurso');

    $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'aluno-tecnico-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
	array(
		'name'=>'alunoNMAluno',
		'value'=>'$data->relAluno->NMAluno',
		'type'=>'text',
		'header'=>'Nome',
	),
	array(
		'name'=>'alunoNumMatricula',
		'value'=>'$data->relAluno->NumMatricula',
		'type'=>'text',
		'header'=>'Matrícula',
	),
	array(
		'name'=>'alunoEmail',
		'value'=>'$data->relAluno->Email',
		'type'=>'text',
		'header'=>'Email',
	),
	array(
		'name'=>'alunoCurso',
		'value'=>'$data->relCurso->NMCurso',
		'type'=>'text',
		'filter'=>$dropCurso,
		'header'=>'Curso',
	),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/aluno/delete", array("id" => $data->relAluno->CDAluno))',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
