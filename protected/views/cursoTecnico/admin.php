<div id="titlePages">
		Cursos Técnicos
</div>


<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Novo curso',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('cursoTecnico/create')
    ));

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'curso-tecnico-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDCurso',
		'NMCurso',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
