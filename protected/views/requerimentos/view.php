<h1>Detalhes do requerimento <?php echo $model->CDModeloRequerimento; ?></h1>

<?php 


$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDModeloRequerimento',
		'NMModeloRequerimento',
		array(
			'label'=>'Opções do Requerimento',
			'value'=>implode(', ',$opcoes),
			'filter'=>false,
		),
	),
)); ?>

<?php



?>
