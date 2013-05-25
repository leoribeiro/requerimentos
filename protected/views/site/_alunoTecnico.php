<?php
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',2);
	$modelT = SS_ModeloRequerimento::model()->find($criteria);

	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',5);
	$modelTG = SS_ModeloRequerimento::model()->find($criteria);

	if(!is_null($modelT)){
		$nomeCT = strtoupper($modelT->NMModeloRequerimento);
	}else{
		$nomeCT = "Erro";
	}
	if(!is_null($modelTG)){
		$nomeCTG = strtoupper($modelTG->NMModeloRequerimento);
	}else{
		$nomeCTG = "Erro";
	}
?>

<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/tecnico.png'),''); ?></div>
<div style="width: 96%;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link($nomeCT,array('Requerimentos/create',
'form'=>'RT')); ?></div>
	<div style="clear: both;"></div>
</div>

<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/fg.png'),''); ?></div>
	<div style="width: 96%;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link($nomeCTG,array('Requerimentos/create',
	'form'=>'RF')); ?></div>
	<div style="clear: both;"></div>
</div>