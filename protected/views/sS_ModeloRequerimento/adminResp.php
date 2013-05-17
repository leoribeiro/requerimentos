<div id="titlePages">
		Permissão para Modelos de Requerimentos
</div>

<div id="statusMsg"></div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ss-modelo-perm-requerimento-grid',
	'dataProvider'=>$model->search(),
	'type'=>'striped bordered',
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
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>' {delete}',
			'deleteButtonUrl'=>'Yii::app()->createUrl("SS_ModeloRequerimento/deleteResp", array("id" => $data->CDModeloRequerimentoServidor))',
			'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
		),
	),
)); ?>
