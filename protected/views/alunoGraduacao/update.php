<?php
$this->breadcrumbs=array(
	'Aluno Graduacaos'=>array('index'),
	$modelAlunoGraduacao->CDAlunoGraduacao=>array('view','id'=>$modelAlunoGraduacao->CDAlunoGraduacao),
	'Update',
);

$this->menu=array(
	array('label'=>'List AlunoGraduacao', 'url'=>array('index')),
	array('label'=>'Create AlunoGraduacao', 'url'=>array('create')),
	array('label'=>'View AlunoGraduacao', 'url'=>array('view', 'id'=>$modelAlunoGraduacao->CDAlunoGraduacao)),
	array('label'=>'Manage AlunoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Editar aluno de graduação ID <?php echo $modelAlunoGraduacao->CDAlunoGraduacao; ?></h1>

<?php
$Tabs     = array
              (
                
                 'tab1'=>array('title'=>'Dados Básicos','view'=>'/aluno/_form',
				 	'data'=>array('model'=>$modelAluno)),
				
                 'tab2'=>array('title'=>'Dados do aluno de graduação','view'=>'/alunoGraduacao/_form',
					'data'=>array('model'=>$modelAlunoGraduacao)),
              );


        $this->widget('CTabView', array('tabs'=>$Tabs,'activeTab'=>$tab));
?>