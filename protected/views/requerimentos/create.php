<div class="tituloReq">
<?php echo $modelModeloRequerimento->NMModeloRequerimento; ?>	
</div>
<?php echo $this->renderPartial('//requerimentos/_formNumRequerimento', array('model'=>$model,'numRequerimento'=>$numRequerimento,'modelRequerimento'=>$modelRequerimento)); ?>

<?php echo $this->renderPartial('//requerimentos/_formAluno', array('model'=>$model,'modelAluno'=>$modelAluno,'modelAlunoGraduacao'=>$modelAlunoGraduacao,'modelAlunoTecnico'=>$modelAlunoTecnico)); ?>

<?php echo $this->renderPartial('//requerimentos/_formOpcoes', array('model'=>$model,'modelRequerimento'=>$modelRequerimento,'modelModeloRequerimento'=>$modelModeloRequerimento)); ?>