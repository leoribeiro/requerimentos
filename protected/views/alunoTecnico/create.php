<h1>Cadastrar aluno de curso técnico</h1>
	<?
	if($firstAluno){
			echo "<div class='flash-success'>É a primeira vez que você entra no sistema.";
			echo "<br />";
			echo "É necessário atualizar seus dados.</div>";
	}
	?>
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