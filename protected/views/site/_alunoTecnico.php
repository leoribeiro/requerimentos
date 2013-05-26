<?php
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',2);
	$modelT = SS_ModeloRequerimento::model()->find($criteria);

	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',5);
	$modelTG = SS_ModeloRequerimento::model()->find($criteria);

	if(!is_null($modelT)){
		$nomeCT = mb_strtoupper($modelT->NMModeloRequerimento,'UTF-8');
	}else{
		$nomeCT = "Erro";
	}
	if(!is_null($modelTG)){
		$nomeCTG = mb_strtoupper($modelTG->NMModeloRequerimento,'UTF-8');
	}else{
		$nomeCTG = "Erro";
	}

	Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/tecnico.png"),'').'</div><div id="contentL">'.CHtml::link($nomeCT,array('Requerimentos/create',
'form'=>'RT')).'</div></div>');

	$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>false,'htmlOptions'=>array('style'=>'height:40px; line-height: 40px;')), // success, info, warning, error or danger
        ),

	));

	Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/fg.png"),'').'</div><div id="contentL">'.CHtml::link($nomeCTG,array('Requerimentos/create',
	'form'=>'RF')).'</div></div>');

	$this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'closeText'=>false, // close link text - if set to false, no close link is displayed
        'alerts'=>array( // configurations per alert type
            'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>false,'htmlOptions'=>array('style'=>'height:40px; line-height: 40px;')), // success, info, warning, error or danger
        ),

	));

?>