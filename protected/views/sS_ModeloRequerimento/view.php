<h1>Detalhes do modelo de requerimento #<?php echo $model->CDModeloRequerimento; ?></h1>

<?php 


$opcoes = array();
foreach($model->relOpcao as $opcao){
				$opcoes[] = $opcao->NMOpcao;
}

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDModeloRequerimento',
		'NMModeloRequerimento',
		'SgRequerimento',
		array(
			'label'=>'Opções do Requerimento',
			'value'=>implode(', ',$opcoes),
			'filter'=>false,
		),
	),
)); ?>

<?php



?>
