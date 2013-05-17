<div id="titlePages">
		Opções de modelos de requerimentos
</div>


<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Nova opção',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('SS_Opcao/create')
    ));

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'ss--opcao-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDOpcao',
		'NMOpcao',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
