
<div id="titlePages">Cadastrar aluno de curso técnico</div>
<?php

    $this->widget('bootstrap.widgets.TbAlert', array(
      'block'=>true, // display a larger alert block?
      'fade'=>true, // use transitions?
      'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
      'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
      ),
    ));

?>
<?php

$activetab = true;
$activetab2 = false;

if($tab == 'tab2'){
	$activetab = false;
	$activetab2 = true;
}

$Tabs     = array
              (
                 array('id'=>'tab1','label'=>'Dados Básicos','content'=>$this->renderPartial('/aluno/_form', array('model'=>$modelAluno), true),'active' => $activetab),
                 array('id'=>'tab2','label'=>'Curso técnico','content'=>$this->renderPartial('/alunoTecnico/_form', array('model'=>$modelAlunoTecnico), true),'active' => $activetab2),
              );


$this->widget('bootstrap.widgets.TbTabs', array(
	'id' => 'mytabs',
   'type' => 'tabs',
  // 'placement'=> 'left',
	'tabs'=>$Tabs));
?>