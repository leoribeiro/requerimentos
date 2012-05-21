<div class="opcoesForm">
<div>
<fieldset>
<legend>Histórico de situações:</legend>

<?
$datas = array();
$observacoes = array();
foreach($modelRequerimento->Situacao_Requerimento as $SR){
	$datas[] = $modelRequerimento->mysql_datetime_para_humano($SR->DataHora);
	$observacoes[] = $SR->Observacoes;
	
}
$cont = 0;
foreach($modelRequerimento->relSituacao as $situacao){
	
	if(is_null($observacoes[$cont])){
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
			),
		));
	}
	

	$cont++;
	echo '<br />';
}
 ?>
</fieldset>
