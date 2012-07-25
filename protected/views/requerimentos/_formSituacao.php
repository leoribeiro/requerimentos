<div class="opcoesForm">
<div>
<fieldset>
<legend>Histórico de situações:</legend>

<?
$datas = array();
$observacoes = array();
$responsaveis = array();
$situacoes = array();

$criteria = new CDbCriteria;
$criteria->order = 'DataHora ASC';
$criteria->compare('SS_Requerimento_CDRequerimento',$modelRequerimento->CDRequerimento);
$modelReq = SS_SituacaoRequerimento::model()->findAll($criteria);

foreach($modelReq as $SR){
	$datas[] = $modelRequerimento->mysql_datetime_para_humano($SR->DataHora);
	$observacoes[] = $SR->Observacoes;
	$situacoes[] = $SR->relSituacao->NMsituacao;
	if(!is_null($SR->relServidor)){
		$responsaveis[] = $SR->relServidor->NMServidor;	
	}
	else{
		$responsaveis[] = null;
	}	
}
for($cont=0;$cont<count($situacoes);$cont++){
		$this->widget('zii.widgets.CDetailView', array(
			'data'=>$modelRequerimento,
			'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
			'attributes'=>array(
				array(
					'label'=>'Situação',
					'value'=>$situacoes[$cont],
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
					'visible'=>(!empty($observacoes[$cont])),
				),	
				array(
					'label'=>'Responsável',
					'value'=>$responsaveis[$cont],
					'filter'=>false,
					'visible'=>(!is_null($responsaveis[$cont])),
				),		
			),
		));		
	echo '<br />';
}
 ?>
</fieldset>
