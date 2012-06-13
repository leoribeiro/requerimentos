<?php

Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('requerimentos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="tituloReq">
<?php echo $modelModeloRequerimento->NMModeloRequerimento; ?>	
</div>
<br />

<div id="statusMsg"></div>

<?
if(isset($_GET['saveSuccess'])){
	$idReq = $_GET['idReq'];
	if($idReq != 0){
		echo "<div class='flash-success'>Requerimento enviado com sucesso.";
		echo "<br />";
		echo CHtml::link('Clique Aqui',array('RelatoriosPDF/geraPDF',
		'idReq'=>$idReq));
		echo " para gerar o requerimento em PDF. É necessário imprimí-lo e levá-lo ao setor responsável.";
		echo "</div>";
	}
	else{
		echo "<div class='flash-success'>Requerimento enviado com sucesso.</div>";
	}
}
	
?>
<?php 
    $criteria = new CDbCriteria;
	$criteria->order = 'NMsituacao';
	$modelSituacao = SS_Situacao::model()->findAll($criteria);
	$dropSituacao = CHtml::listData($modelSituacao,'CDSituacao','NMsituacao');
	if(!is_null(Yii::app()->user->getModelAluno())){
		$modelC = $model->search('Aluno');
	}
	else{
		$modelC = $model->search();
	}
	
	$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
	
	if(!is_null(Yii::app()->user->getModelAluno())){
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'requerimentos-grid',
		'dataProvider'=>$modelC,
		'filter'=>$model,
		'columns'=>array(
			//'CDRequerimentoAlunoRegistroEscolar',
			array(
				'name'=>'NumRequerimento',
				'value'=>'$data->getNumRequerimento()',
				'type'=>'text',
				'header'=>'Requerimento',
			),

			array(
				'name'=>'Situacao',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,1)',
				'type'=>'text',
				'filter'=>$dropSituacao,
				'header'=>'Situação',
			),
			array(
				'name'=>'DtPedido',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,2)',
				'type'=>'text',
				'header'=>'Data',
				'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
                    'model'=>$model,
                    'attribute'=>'DtPedido',
                    'language'=>'pt-BR',
					'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
		            'htmlOptions' => array(
                      'id' => 'datepicker_for_due_date',
                      'size' => '10',
                    ),
					'defaultOptions' => array(  // (#3)
	                    'showOn' => 'focus', 
	                    'dateFormat' => 'dd/mm/yy',
	                    'showOtherMonths' => true,
	                    'selectOtherMonths' => true,
	                    'changeMonth' => true,
	                    'changeYear' => true,
	                    'showButtonPanel' => true,
	                )
	           ), true),
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>' {view} {geraPDF} {geraPDFd}',
				'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
			      array(
			           'onchange'=>"$.fn.yiiGridView.update('requerimentos-grid',{ data:{pageSize: $(this).val() }})",
					   'style'=>' font-size: 12px; padding: 0px;margin-bottom: 0px;',
			      )),
				'buttons' => array(
				'geraPDF' => array(
				            'label'=>'Gerar PDF',
							'url'=> 'Yii::app()->createUrl("RelatoriosPDF/geraPDF", array("idReq" => $data->relRequerimento->CDRequerimento))',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdf.png',
				            'visible'=>'$data->relRequerimento->getPrecisaGerarPDF()',
				),
				'geraPDFd' => array(
				            'label'=>'Opção indisponível',
							//'url'=> 'Yii::app()->createUrl("#")',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdfd.png',
				            'visible'=>'!$data->relRequerimento->getPrecisaGerarPDF()',
				),
		    	),
				'viewButtonUrl'=>'Yii::app()->createUrl("Requerimentos/view", array("id" => $data->relRequerimento->CDRequerimento))',
				),					

		),
	));
 }
 else{
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'requerimentos-grid',
		'dataProvider'=>$modelC,
		'filter'=>$model,
		'afterAjaxUpdate' => 'reinstallDatePicker',
		'columns'=>array(
			//'CDRequerimentoAlunoRegistroEscolar',
			array(
				'name'=>'NumRequerimento',
				'value'=>'$data->getNumRequerimento()',
				'type'=>'text',
				'header'=>'Requerimento',
			),
			array(
				'name'=>'nomeAluno',
				'value'=>'$data->relRequerimento->relAluno->NMAluno',
				'type'=>'text',
				'header'=>'Aluno',
			),

			array(
				'name'=>'Situacao',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,1)',
				'type'=>'text',
				'filter'=>$dropSituacao,
				'header'=>'Situação',
			),
			array(
				'name'=>'DtPedido',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,2)',
				'type'=>'text',
				'header'=>'Data',
				'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
                    'model'=>$model,
                    'attribute'=>'DtPedido',
                    'language'=>'pt-BR',
					'i18nScriptFile' => 'jquery.ui.datepicker-ja.js', // (#2)
		            'htmlOptions' => array(
                      'id' => 'datepicker_for_due_date',
                      'size' => '10',
                    ),
					'defaultOptions' => array(  // (#3)
	                    'showOn' => 'focus', 
	                    'dateFormat' => 'dd/mm/yy',
	                    'showOtherMonths' => true,
	                    'selectOtherMonths' => true,
	                    'changeMonth' => true,
	                    'changeYear' => true,
	                    'showButtonPanel' => true,
	                )
	           ), true),
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view} {update} {geraPDF} {geraPDFd} {delete}',
				'htmlOptions' => array('width'=>75),
				'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,50=>50,100=>100),
			      array(
			           'onchange'=>"$.fn.yiiGridView.update('requerimentos-grid',{ data:{pageSize: $(this).val() }})",
					   'style'=>' font-size: 10px; padding: 0px;margin-bottom: 0px;',
			      )),
				'buttons'=> array(
				'update' => array(
					'label'=>'Alterar Situação',
					'imageUrl'=>Yii::app()->request->baseUrl
					.'/images/b_newtbl.png',
				),
				'geraPDF' => array(
				            'label'=>'Gerar PDF',
							'url'=> 'Yii::app()->createUrl("RelatoriosPDF/geraPDF", array("idReq" => $data->relRequerimento->CDRequerimento))',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdf.png',
				            'visible'=>'$data->relRequerimento->getPrecisaGerarPDF()',
				),
				'geraPDFd' => array(
				            'label'=>'Opção indisponível',
							//'url'=> 'Yii::app()->createUrl("#")',
							'imageUrl'=>Yii::app()->request->baseUrl
							.'/images/pdfd.png',
				            'visible'=>'!$data->relRequerimento->getPrecisaGerarPDF()',
				),
				'delete' => array(
				            'visible'=>'(Yii::app()->user->name == \'admin\')',
				),
				),
				//'deleteButtonUrl'=>'Yii::app()->createUrl("delete", array("id" => $data->relRequerimento->CDRequerimento))',
				'viewButtonUrl'=>'Yii::app()->createUrl("Requerimentos/view", array("id" => $data->relRequerimento->CDRequerimento))',
				'updateButtonUrl'=>'Yii::app()->createUrl("Requerimentos/view", array("id" => $data->relRequerimento->CDRequerimento, "alterarSituacao"=> 1))',
				'deleteButtonUrl'=>'Yii::app()->createUrl("/SS_Requerimento/delete", array("id" => $data->relRequerimento->CDRequerimento))',
				'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
			),
		),
	));
}	

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker();
}
");
	 ?>
