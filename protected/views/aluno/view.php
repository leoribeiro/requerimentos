<?php
$this->breadcrumbs=array(
	'Alunos'=>array('index'),
	$model->CDAluno,
);

$this->menu=array(
	array('label'=>'List Aluno', 'url'=>array('index')),
	array('label'=>'Create Aluno', 'url'=>array('create')),
	array('label'=>'Update Aluno', 'url'=>array('update', 'id'=>$model->CDAluno)),
	array('label'=>'Delete Aluno', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CDAluno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Aluno', 'url'=>array('admin')),
);
?>

<h1>View Aluno #<?php echo $model->CDAluno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CDAluno',
		'NMAluno',
		'NumMatricula',
		'Bairro',
		'CEP',
		'EnderecoRua',
		'EnderecoNumero',
		'Email',
		'Telefone',
		'DataNascimento',
		'Sexo',
	),
)); ?>
