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

	<?																																				if(!is_null(Yii::app()->user->getModelAluno()))
{																																			?>																																			
	<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/registroescolar.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO AO SETOR DE REGISTRO ESCOLAR',array('Requerimentos/create',
'form'=>'RR')); ?> </div>
	<div style="clear: both;"></div>
	</div>																																											


	<?																																				if(Yii::app()->user->getTipoAluno() == 1)
{																																			?>																																														<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/tecnico.png'),''); ?></div>
<div style="width: 96%;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO DO ALUNO - CURSO TECNICO',array('Requerimentos/create',
'form'=>'RT')); ?></div>
	<div style="clear: both;"></div>
	</div>																																															<?																																				}																																			?>	

<?																																				if(Yii::app()->user->getTipoAluno() == 2)
{																																			?>																																							<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/graduacao.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO DO ALUNO - GRADUAÇÃO',array('Requerimentos/create',
'form'=>'RG')); ?></div>
	<div style="clear: both;"></div>
	</div>																																														
	<?																																				}																																			?>																																															<div class='msglogin'>
<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/estagio.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO À COORDENAÇÃO DE PROGRAMAS DE ESTÁGIO',array('Requerimentos/create',
'form'=>'RE')); 
?></div>
	<div style="clear: both;"></div>
	</div>																																														<?																																				}	
else{																																											
	echo "<h1>Estatísticas Gerais</h1>";

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ss-requerimento-grid',
		'dataProvider'=>$modelEstatistica->search(),
		//'filter'=>$model,
	'summaryText' => '',
	'columns'=>array(
		//'CDRequerimentoAlunoRegistroEscolar',
	array(
		'name'=>'NMModeloRequerimento',
		'value'=>'$data->NMModeloRequerimento',
		'type'=>'text',
		'header'=>'Tipo de Requerimento',
		),


		),
		));

	echo "<h1>Estatísticas do mês de ".date('M')."</h1>";

	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'ss-requerimento-grid',
		'dataProvider'=>$modelEstatistica->search(),
		//'filter'=>$model,
	'summaryText' => '',
	'columns'=>array(
		//'CDRequerimentoAlunoRegistroEscolar',
	array(
		'name'=>'NMModeloRequerimento',
		'value'=>'$data->NMModeloRequerimento',
		'type'=>'text',
		'header'=>'Tipo de Requerimento',
		),


		),
		));
	}																																																																																								?>







