<?php
Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
?>
<hr>
<h3>Requerimentos Enviados</h3>

<?php
	$mes = array(1=>"Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
	$md = date('n');

	$criteria = new CDbCriteria;
	$criteria->order = 'NMModeloRequerimento';
	$modelGrafico = SS_ModeloRequerimento::model()->findAll($criteria);
	$ReqsGraf = array();
	$ReqsGraf3 = array();
	foreach($modelGrafico as $m1){
		$ReqsGraf[] = array($m1->NMModeloRequerimento,(int)$m1->getTotal());
	}
	$ReqsGraf1 =$ReqsGraf;
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
	sort($modelosN);
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

?>
	<div align='center'>
		<div id='chart_div'></div>
		</div> <hr>
		<hr><div align='center'>

		<h3>Estatísticas do ano de <?php echo date("Y") ?></h3>
		<div id='chart_div2'></div>
	</div>
	<hr>

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
        data.addRows(<?php print json_encode($ReqsGraf1); ?>);

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
		        var data = google.visualization.arrayToDataTable(<?php print json_encode($ReqsGraf2); ?>);

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