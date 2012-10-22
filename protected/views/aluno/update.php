<?php
$this->breadcrumbs=array(
	'Alunos'=>array('index'),
	$model->CDAluno=>array('view','id'=>$model->CDAluno),
	'Update',
);

$this->menu=array(
	array('label'=>'List Aluno', 'url'=>array('index')),
	array('label'=>'Create Aluno', 'url'=>array('create')),
	array('label'=>'View Aluno', 'url'=>array('view', 'id'=>$model->CDAluno)),
	array('label'=>'Manage Aluno', 'url'=>array('admin')),
);
?>

<h1>Update Aluno <?php echo $model->CDAluno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>