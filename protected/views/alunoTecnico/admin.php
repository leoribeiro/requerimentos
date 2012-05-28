<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('aluno-tecnico-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Alunos de curso técnico</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'alunoTecnico','descricao'=>'Aluno')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div id="statusMsg"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'aluno-tecnico-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDAlunoTecnico',
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
		'header'=>'Curso',
	),
		array(
			'class'=>'CButtonColumn',
			'deleteButtonUrl'=>'Yii::app()->createUrl("/aluno/delete", array("id" => $data->relAluno->CDAluno))',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
