

<h1>Graduacao ID - <?php echo $model->CDCurso; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDCurso',
		'NMCurso',
	),
)); ?>
