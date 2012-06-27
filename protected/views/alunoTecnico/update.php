<h1>Editar - Aluno do técnico - <?php echo $modelAlunoTecnico->relAluno->NumMatricula; ?></h1>

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