<div id="titlePages">
		Situações
</div>

<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Nova situação',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('SS_Situacao/create')
    ));

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ss--situacao-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDSituacao',
		'NMsituacao',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
