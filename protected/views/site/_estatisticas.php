<h3>Estatísticas Gerais</h3>

<?php
	$modelEstatistica=new SS_ModeloRequerimento('search');
	$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'ss-requerimento-grid',
		'type'=>'striped bordered condensed',
		'enableSorting' => false,
		'dataProvider'=>$modelEstatistica->search(),
		'summaryText' => '',
		'columns'=>array(
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
?>
<hr>
<h3>Estatísticas do mês de <?php echo $mes[$md]; ?></h3>
<?php
	$this->widget('bootstrap.widgets.TbGridView', array(
		'id'=>'ss-requerimento-grid',
		'type'=>'striped bordered condensed',
		'enableSorting' => false,
		'dataProvider'=>$modelEstatistica->search(),
		'summaryText' => '',
		'columns'=>array(
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
?>