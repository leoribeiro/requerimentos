<?php
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',1);
	$modelR = SS_ModeloRequerimento::model()->find($criteria);

	if(!is_null($modelR)){
		$nomeR = strtoupper($modelR->NMModeloRequerimento);
	}else{
		$nomeR = "Erro";
	}

	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',4);
	$modelE = SS_ModeloRequerimento::model()->find($criteria);


	if(!is_null($modelR)){
		$nomeE = strtoupper($modelE->NMModeloRequerimento);
	}else{
		$nomeE = "Erro";
	}
?>
<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/registroescolar.png'),''); ?></div>
	<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link($nomeR,array('Requerimentos/create',
'form'=>'RR')); ?>
	</div>
	<div style="clear: both;"></div>
</div>

<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;">
	<?php echo CHtml::image($this->createUrl('images/estagio.png'),''); ?>
	</div>
	<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;">
	<?php echo CHtml::link($nomeE,array('Requerimentos/create',
		'form'=>'RE')); ?>
	</div>
	<div style="clear: both;"></div>
</div>