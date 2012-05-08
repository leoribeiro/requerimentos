<?php
$this->breadcrumbs=array(
	'Ss  Modelo Requerimentos'=>array('index'),
	$model->CDModeloRequerimento,
);

$this->menu=array(
	array('label'=>'List SS_ModeloRequerimento', 'url'=>array('index')),
	array('label'=>'Create SS_ModeloRequerimento', 'url'=>array('create')),
	array('label'=>'Update SS_ModeloRequerimento', 'url'=>array('update', 'id'=>$model->CDModeloRequerimento)),
	array('label'=>'Delete SS_ModeloRequerimento', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDModeloRequerimento),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SS_ModeloRequerimento', 'url'=>array('admin')),
);
?>

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
		array(
			'label'=>'Opções do Requerimento',
			'value'=>implode(', ',$opcoes),
			'filter'=>false,
		),
	),
)); ?>

<?php



?>
