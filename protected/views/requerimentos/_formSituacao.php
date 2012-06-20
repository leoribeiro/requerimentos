<div class="opcoesForm">
<div>
<fieldset>
<legend>Histórico de situações:</legend>

<?
$datas = array();
$observacoes = array();
$responsaveis = array();

foreach($modelRequerimento->Situacao_Requerimento as $SR){
	$datas[] = $modelRequerimento->mysql_datetime_para_humano($SR->DataHora);
	$observacoes[] = $SR->Observacoes;
	if(!is_null($SR->relServidor)){
		$responsaveis[] = $SR->relServidor->NMServidor;	
	}
	else{
		$responsaveis[] = null;
	}
	
	
	
}
$cont = 0;
foreach($modelRequerimento->relSituacao as $situacao){
	
	if(empty($observacoes[$cont])){
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$modelRequerimento,
			'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
			'attributes'=>array(
				array(
					'label'=>'Situação',
					'value'=>$situacao->NMsituacao,
					'filter'=>false,
				),
				array(
					'label'=>'Data',
					'value'=>$datas[$cont],
					'filter'=>false,
				),		
				array(
					'label'=>'Responsável',
					'value'=>$responsaveis[$cont],
					'filter'=>false,
					'visible'=>(!is_null($responsaveis[$cont])),
				),		
			),
		));		
	}
	else{
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$modelRequerimento,
			'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
			'attributes'=>array(
				array(
					'label'=>'Situação',
					'value'=>$situacao->NMsituacao,
					'filter'=>false,
				),
				array(
					'label'=>'Data',
					'value'=>$datas[$cont],
					'filter'=>false,
				),
				array(
					'label'=>'Observação',
					'value'=>$observacoes[$cont],
					'filter'=>false,
				),	
				array(
					'label'=>'Responsável',
					'value'=>$responsaveis[$cont],
					'filter'=>false,
					'visible'=>(!is_null($responsaveis[$cont])),
				),			
			),
		));
	}
	

	$cont++;
	echo '<br />';
}
 ?>
</fieldset>
