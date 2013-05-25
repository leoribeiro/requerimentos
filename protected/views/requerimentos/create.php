<div id="titlePages">
<?php 
function convertem($term, $tp) { 
    if ($tp == "1") $palavra = strtr(strtoupper($term),"àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ","ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß"); 
    elseif ($tp == "0") $palavra = strtr(strtolower($term),"ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß","àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ"); 
    return $palavra; 
}

echo convertem($modelModeloRequerimento->NMModeloRequerimento,1); ?>	
</div>
<?php echo $this->renderPartial('//requerimentos/_formNumRequerimento', array('model'=>$model,'numRequerimento'=>$numRequerimento,'modelRequerimento'=>$modelRequerimento)); ?>

<?php echo $this->renderPartial('//requerimentos/_formAluno', array('model'=>$model,'modelAluno'=>$modelAluno,'modelAlunoGraduacao'=>$modelAlunoGraduacao,'modelAlunoTecnico'=>$modelAlunoTecnico)); ?>

<?php echo $this->renderPartial('//requerimentos/_formOpcoes', array('model'=>$model,'modelRequerimento'=>$modelRequerimento,'modelModeloRequerimento'=>$modelModeloRequerimento)); ?>

