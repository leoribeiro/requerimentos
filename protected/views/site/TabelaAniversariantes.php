<h2>Aniversariantes do Mês</h2>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-formacao-grid',
	'dataProvider'=>$dataProvider,
	'enablePagination' => false,
	'enableSorting' => false,
	'summaryText' => '',
	//'filter'=>$modelFilter,
	'columns'=>array(
		'CDServidor',
		'NMServidor',
		'DataNascimento',

	),
));

?>