<?php
$this->breadcrumbs=array(
	'Aluno de graduação'=>array('index'),
	'Cadastro',
);

$this->menu=array(
	array('label'=>'List AlunoGraduacao', 'url'=>array('index')),
	array('label'=>'Manage AlunoGraduacao', 'url'=>array('admin')),
);
?>

<h1>Cadastrar aluno de graduação</h1>

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