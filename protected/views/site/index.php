<?php $this->pageTitle=Yii::app()->name; ?>
<style>

	.iframeDialogBg{
		/* use this css style to customize your iframe-HOLDER inside of dialogbox */
		height: 100%;
		width: 100%;
	}
	.iframeDialog{
		/* use this css style to customize your IFRAME inside of dialogbox */
		height: 100%;
		width: 100%;
	}
</style>

<br />
																																			<div  class="row4" >																																			
																																			
																																														<div class='msglogin'>
																																														<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/registroescolar.png'),''); ?></div>
																																														<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO AO SETOR DE REGISTRO ESCOLAR',array('Requerimentos/create',
																																														                                         'form'=>'RR')); ?> </div>
																																															<div style="clear: both;"></div>
</div>																																											
																																														<div class='msglogin'>
																																														<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/tecnico.png'),''); ?></div>
																																														<div style="width: 96%;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO DO ALUNO - CURSO TECNICO',array('Requerimentos/create',
																																																									                                         'form'=>'RAT')); ?></div>
																																															<div style="clear: both;"></div>
</div>																																														
																																														<div class='msglogin'>
																																														<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/graduacao.png'),''); ?></div>
																																														<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO DO ALUNO - GRADUAÇÃO',array('Requerimentos/create',
																																																									                                         'form'=>'RAG')); ?></div>
																																															<div style="clear: both;"></div>
</div>																																														
																																														<div class='msglogin'>
																																														<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/estagio.png'),''); ?></div>
																																														<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO À COORDENAÇÃO DE PROGRAMAS DE ESTÁGIO',array('Requerimentos/create',
																																														                                         'form'=>'RET')); ?></div>
																																														<div style="clear: both;"></div>
</div>
	



