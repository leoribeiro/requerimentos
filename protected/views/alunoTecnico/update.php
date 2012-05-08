<?php
$this->breadcrumbs=array(
	'Aluno Tecnicos'=>array('index'),
	$modelAlunoTecnico->CDAlunoTecnico=>array('view','id'=>$modelAlunoTecnico->CDAlunoTecnico),
	'Update',
);

$this->menu=array(
	array('label'=>'List AlunoTecnico', 'url'=>array('index')),
	array('label'=>'Create AlunoTecnico', 'url'=>array('create')),
	array('label'=>'View AlunoTecnico', 'url'=>array('view', 'id'=>$modelAlunoTecnico->CDAlunoTecnico)),
	array('label'=>'Manage AlunoTecnico', 'url'=>array('admin')),
);
?>

<h1>Editar aluno do técnico ID <?php echo $modelAlunoTecnico->CDAlunoTecnico; ?></h1>

<?php
$Tabs     = array
              (
                
                 'tab1'=>array('title'=>'Dados Básicos','view'=>'/aluno/_form',
				 	'data'=>array('model'=>$modelAluno)),
				
                 'tab2'=>array('title'=>'Dados do aluno de curso técnico','view'=>'/alunoTecnico/_form',
					'data'=>array('model'=>$modelAlunoTecnico)),
              );


        $this->widget('CTabView', array('tabs'=>$Tabs,'activeTab'=>$tab));
?>