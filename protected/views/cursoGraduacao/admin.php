<div id="titlePages">
		Cursos de graduação
</div>


<?php
	$this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Novo curso',
        'type'=>'primary',
        'size'=>'',
        'url'=>$this->createUrl('cursoGraduacao/create')
    ));

	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'curso-graduacao-grid',
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
