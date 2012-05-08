<?php
$this->breadcrumbs=array(
	'Aluno de curso técnico'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'List AlunoTecnico', 'url'=>array('index')),
	array('label'=>'Manage AlunoTecnico', 'url'=>array('admin')),
);
?>

<h1>Cadastrar aluno de curso técnico</h1>

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