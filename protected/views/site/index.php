<?php $this->pageTitle=Yii::app()->name; 

function convertem($term, $tp) { 
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
    return $palavra; 
}

?>
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
{	
			
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',1);
	$modelR = SS_ModeloRequerimento::model()->find($criteria);

	
	if(!is_null($modelR)){
		$nomeR = convertem($modelR->NMModeloRequerimento,1);
	}else{
		$nomeR = "Erro";
	}
																																		?>																																			
	<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/registroescolar.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link($nomeR,array('Requerimentos/create',
'form'=>'RR')); ?> </div>
	<div style="clear: both;"></div>
	</div>																																											


	<?																																				if(Yii::app()->user->getTipoAluno() == 1)
{		

			
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',2);
	$modelT = SS_ModeloRequerimento::model()->find($criteria);
	
	$criteria = new CDbCriteria;
	$criteria->compare('CDModeloRequerimento',5);
	$modelTG = SS_ModeloRequerimento::model()->find($criteria);
	
	if(!is_null($modelT)){
		$nomeCT = convertem($modelT->NMModeloRequerimento,1);
	}else{
		$nomeCT = "Erro";
	}
	if(!is_null($modelTG)){
		$nomeCTG = convertem($modelTG->NMModeloRequerimento,1);
	}else{
		$nomeCTG = "Erro";
	}
																																?>																																														<div class='msglogin'>
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
		</div>																																													<?																																				}																																			?>	

<?		
																																if(Yii::app()->user->getTipoAluno() == 2)
{																																			?>																																							<div class='msglogin'>
	<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/graduacao.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link('REQUERIMENTO DO ALUNO - GRADUAÇÃO',array('Requerimentos/create',
'form'=>'RG')); ?></div>
	<div style="clear: both;"></div>
	</div>																																														
	<?																																				}

$criteria = new CDbCriteria;
$criteria->compare('CDModeloRequerimento',4);
$modelE = SS_ModeloRequerimento::model()->find($criteria);


if(!is_null($modelR)){
	$nomeE = convertem($modelR->NMModeloRequerimento,1);
}else{
	$nomeE = "Erro";
}
																																			?>																																															<div class='msglogin'>
<div style="width: 4%; float: left;height:40px;display:table-cell;padding:5px;vertical-align:middle;"><? echo CHtml::image($this->createUrl('images/estagio.png'),''); ?></div>
<div style="width: 96%; height:40px;display:table-cell;padding:5px;vertical-align:middle;"><?php echo CHtml::link($nomeE,array('Requerimentos/create',
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

	array(
		'name'=>'TotalReq',
		'value'=>'$data->getTotal()',
		'type'=>'text',
		'header'=>'Quantidade de requerimentos',
		),
		),
		));
	$mes = array(1=>"Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	$md = date('n');
	echo "<h1>Estatísticas do mês de ".$mes[$md]."</h1>";

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

	array(
		'name'=>'TotalReq',
		'value'=>'$data->getTotal("Mes")',
		'type'=>'text',
		'header'=>'Quantidade de requerimentos',
		),
		),
		));
	}	
	//echo Yii::app()->user->CDUsuario;																																																																																							?>







