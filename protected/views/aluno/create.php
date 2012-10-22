<?php
$this->breadcrumbs=array(
	'Alunos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Aluno', 'url'=>array('index')),
	array('label'=>'Manage Aluno', 'url'=>array('admin')),
);
?>

<h1>Create Aluno</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>