<?php


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss-requerimento-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1><? echo($modelModeloRequerimento->NMModeloRequerimento); ?></h1>
<?
if(isset($_GET['saveSuccess'])){
	$idReq = $_GET['idReq'];
	if($idReq != 0){
		echo "<div class='flash-success'>Requerimento enviado com sucesso.";
		echo "<br />";
		echo CHtml::link('Clique Aqui',array('RelatoriosPDF/geraPDF',
		'idReq'=>$idReq));
		echo " para gerar o requerimento em PDF. É necessário imprimí-lo e levá-lo ao setor responsável";
		echo "</div>";
	}
	else{
		echo "<div class='flash-success'>Requerimento enviado com sucesso.</div>";
	}
}
	
?>
<?php 
	if(!is_null(Yii::app()->user->getModelAluno())){
		$modelC = $model->search('Aluno');
	}
	else{
		$modelC = $model->search();
	}
	
	if(!is_null(Yii::app()->user->getModelAluno())){
		$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ss-requerimento-grid',
		'dataProvider'=>$modelC,
		//'filter'=>$model,
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
				'header'=>'Situação',
			),
			array(
				'name'=>'DtPedido',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,2)',
				'type'=>'text',
				'header'=>'Data',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>' {view} {geraPDF} {geraPDFd}',
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
		'id'=>'ss-requerimento-grid',
		'dataProvider'=>$modelC,
		//'filter'=>$model,
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
				'header'=>'Situação',
			),
			array(
				'name'=>'dtPedido',
				'value'=>'$data->relRequerimento->getUltimaSituacao($data->relRequerimento->CDRequerimento,2)',
				'type'=>'text',
				'header'=>'Data',
			),
			array(
				'class'=>'CButtonColumn',
				'template'=>'{view}{update}{geraPDF} {geraPDFd}',
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
				),
				//'deleteButtonUrl'=>'Yii::app()->createUrl("delete", array("id" => $data->relRequerimento->CDRequerimento))',
				'viewButtonUrl'=>'Yii::app()->createUrl("Requerimentos/view", array("id" => $data->relRequerimento->CDRequerimento))',
				'updateButtonUrl'=>'Yii::app()->createUrl("Requerimentos/view", array("id" => $data->relRequerimento->CDRequerimento, "alterarSituacao"=> 1))',
			),
		),
	));
}	
	 ?>
