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