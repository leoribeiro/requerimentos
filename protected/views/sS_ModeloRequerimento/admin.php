<div id="titlePages">
		Modelos de Requerimentos
</div>

<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Novo modelo',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('SS_ModeloRequerimento/create')
    ));

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ss-modelo-requerimento-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'CDModeloRequerimento',
		'NMModeloRequerimento',
		'SgRequerimento',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
