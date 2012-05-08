<?php
$this->breadcrumbs=array(
	'Alunos de Graduação'=>array('index'),
	'Gerenciar',
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('aluno-graduacao-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Alunos de graduação</h1>


<? $this->renderPartial('/site/botoes',array('modelo'=>'alunoGraduacao','descricao'=>'Aluno')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'aluno-graduacao-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDAlunoGraduacao',
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
		),
	),
)); ?>
