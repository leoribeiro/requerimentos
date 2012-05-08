<?php
$this->breadcrumbs=array(
	'Ss  Opcaos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SS_Opcao', 'url'=>array('index')),
	array('label'=>'Create SS_Opcao', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ss--opcao-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Opções de modelos de requerimentos</h1>

<? $this->renderPartial('/site/botoes',array('modelo'=>'SS_Opcao','descricao'=>'opção modelo de requerimento')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ss--opcao-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'CDOpcao',
		'NMOpcao',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
