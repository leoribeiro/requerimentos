<?php
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',1);
	$modelR = SS_ModeloRequerimento::model()->find($criteria);

	if(!is_null($modelR)){
		$nomeR = mb_strtoupper($modelR->NMModeloRequerimento,'UTF-8');
	}else{
		$nomeR = "Erro";
	}

	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',4);
	$modelE = SS_ModeloRequerimento::model()->find($criteria);


	if(!is_null($modelR)){
		$nomeE = mb_strtoupper($modelE->NMModeloRequerimento,'UTF-8');
	}else{
		$nomeE = "Erro";
	}

	Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/registroescolar.png"),'').'</div><div id="contentL">'.CHtml::link($nomeR,array('Requerimentos/create',
'form'=>'RR')).'</div></div>');

	Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/estagio.png"),'').'</div><div id="contentL">'.CHtml::link($nomeE,array('Requerimentos/create',
		'form'=>'RE')).'</div></div>');
?>



<?php $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>false,'htmlOptions'=>array('style'=>'height:100px;')), // success, info, warning, error or danger
        ),

)); ?>