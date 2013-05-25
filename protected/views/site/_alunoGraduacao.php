<?php
Yii::app()->user->setFlash('info', '<div id="containerL"><div id="primaryL">'.CHtml::image($this->createUrl("images/graduacao.png"),'').'</div><div id="contentL">'.CHtml::link('REQUERIMENTO DO ALUNO - GRADUAÇÃO',array('Requerimentos/create',
'form'=>'RG')).'</div></div>');

?>