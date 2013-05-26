<?php
Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/graduacao.png"),'').'</div><div id="contentL">'.CHtml::link('REQUERIMENTO DO ALUNO - GRADUAÇÃO',array('Requerimentos/create',
'form'=>'RG')).'</div></div>');

$this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'closeText'=>false, // close link text - if set to false, no close link is displayed
    'alerts'=>array( // configurations per alert type
        'info'=>array('block'=>true, 'fade'=>true, 'closeText'=>false,'htmlOptions'=>array('style'=>'height:40px; line-height: 40px;')), // success, info, warning, error or danger
    ),

));

?>