<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss--modelo-requerimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Permissão para Modelos de Requerimentos</h1>

<div id="statusMsg"></div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss-modelo-perm-requerimento-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'reqNMRequerimento',
			'value'=>'$data->relModeloRequerimento->NMModeloRequerimento',
			'type'=>'text',
			'header'=>'Requerimento',
		),
		array(
			'name'=>'servidorNMServidor',
			'value'=>'$data->relServidor->NMServidor',
			'type'=>'text',
			'header'=>'Servidor Responsável',
		),
		array(
			'name'=>'cursoTecnicoNMCurso',
			'value'=>'!is_null($data->relCursoTecnico) ? $data->relCursoTecnico->NMCurso : "" ',
			'type'=>'text',
			'header'=>'Curso Técnico',
		),
		array(
			'name'=>'cursoGraduacaoNMCurso',
			'value'=>'!is_null($data->relCursoGraduacao) ? $data->relCursoGraduacao->NMCurso : ""',
			'type'=>'text',
			'header'=>'Graduação',
		),


		array(
			'class'=>'CButtonColumn',
			'template'=>' {delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("SS_ModeloRequerimento/deleteResp", array("id" => $data->CDModeloRequerimentoServidor))',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
