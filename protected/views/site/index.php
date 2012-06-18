<?php $this->pageTitle=Yii::app()->name; 

function convertem($term, $tp) { 
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
    return $palavra; 
}

Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');

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
		
		echo "<hr><h1>Requerimentos Enviados</h1>";
		
		
		$criteria = new CDbCriteria;
		$criteria->order = 'NMModeloRequerimento';
		$modelGrafico = SS_ModeloRequerimento::model()->findAll($criteria);
		$ReqsGraf = array();
		$ReqsGraf3 = array();
		foreach($modelGrafico as $m1){
			$ReqsGraf[] = array($m1->NMModeloRequerimento,(int)$m1->getTotal());
		}
		$ReqsGraf1 =$ReqsGraf;
		echo "<div align='center'>";
		echo "<div id='chart_div'></div>";
		echo "</div> <hr>";
		
		
		$ReqsGraf = array();
		
		$criteria = new CDbCriteria;
		$criteria->order = 'NMModeloRequerimento';
		$modelReqs = SS_ModeloRequerimento::model()->findAll($criteria);
		$modelos = array();
		$modelosNome = array();
		$modelosN = array();
		$modelosN[] = 'Mês';
		foreach($modelReqs as $m){
			$modelos[] = $m->CDModeloRequerimento;
			$modelosNome[$m->CDModeloRequerimento] = $m->NMModeloRequerimento;
			$modelosN[] = $m->NMModeloRequerimento;
		}

		
		$ReqsLinha = array();
		$ReqsLinha[] = $modelosN;
		
		for($x=1;$x<13;$x++){
			
			$criteria = new CDbCriteria;
			$criteria->with = array('relModeloRequerimento'=>
			array('select'=>'NMModeloRequerimento')
			,'relSituacao');
			$criteria->together = true;
			
			$criteria->select = 'COUNT(*) as TotalReq';
			$criteria->compare('SS_Situacao_CDSituacao',1);
			$criteria->compare('DataHora','>='.date('Y')."-".$x.'-01');
			$criteria->compare('DataHora','<'.
			date('Y-m',strtotime(date('Y')."-".$x."+1 month")).'-01');
			$criteria->group = 'SS_ModeloRequerimento_CDModeloRequerimento';
			$modelGrafico = SS_Requerimento::model()->findAll($criteria);	

			$ReqsZero = array();
			$Reqs = array();
			
			foreach($modelGrafico as $m1){
				$Reqs[$m1->relModeloRequerimento->NMModeloRequerimento] = $m1->TotalReq;
				$ReqsZero[] = $m1->relModeloRequerimento->CDModeloRequerimento;
			}
			$ReqsZero = array_diff($modelos,$ReqsZero);
			foreach($ReqsZero as $R){
				$Reqs[$modelosNome[$R]] = 0;
			}
			ksort($Reqs);
			$ReqsColuna = array();
			$ReqsColuna[] = $mes[$x];
			foreach($Reqs as $MN=>$ValorM){
				$ReqsColuna[] = (int)$ValorM;
			}
			$ReqsLinha[] = $ReqsColuna;
			
		}


		$ReqsGraf2 = $ReqsLinha; 
		//$ReqsGraf2 = $ReqsGrafNew;
		echo "<hr><div align='center'>";

		echo "<h1>Estatísticas do ano de ".date("Y")."</h1>";
		echo "<div id='chart_div2'></div>";
		echo "</div> <hr>";
		
?>

    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows(<? print json_encode($ReqsGraf1); ?>);

        // Set chart options
        var options = {'title':' ',
                       'width':1100,
                       'height':400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

		<script type="text/javascript">
		      google.load("visualization", "1", {packages:["corechart"]});
		      google.setOnLoadCallback(drawChart);
		      function drawChart() {
		        var data = google.visualization.arrayToDataTable(<? print json_encode($ReqsGraf2); ?>);

		        var options = {
		          title: '',
		 		  width:1200, height:600,
		          vAxis: {title: 'Quantidade',  titleTextStyle: {color: 'red'}},
				  legend: {position: 'bottom', alignment: 'end'},
				  hAxis: {title: 'Mês',  titleTextStyle: {color: 'red'}, gridlines :{color: '#000', count: 12}},
		        };

		        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
		        chart.draw(data, options);
		      }
		    </script>

<?
		
}	
	//echo Yii::app()->user->CDUsuario;																																																																																							?>







