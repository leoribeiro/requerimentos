<h1>Opção ID - <?php echo $model->CDOpcao; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDOpcao',
		'NMOpcao',
	),
)); 
?>
