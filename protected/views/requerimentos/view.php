<div id="titlePages">
<?php echo $modelRequerimento->relModeloRequerimento->NMModeloRequerimento; ?>
</div>
<br />
<?
if($saveSuccess){
		echo "<div class='flash-success'>Situação adicionada com sucesso.</div>";
}
?>
<?php
	$url = $urlReq;
	$this->widget('bootstrap.widgets.TbButton', array(
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
));
?>
<?php echo $this->renderPartial('//requerimentos/_formNumRequerimento', array('model'=>$model,'numRequerimento'=>$numRequerimento,'modelRequerimento'=>$modelRequerimento)); ?>


<?php
	$criteria = new CDbCriteria;
	$criteria->compare('Aluno_CDAluno',
	$modelRequerimento->Aluno_CDAluno);
	$modelAlunoTecnico  = AlunoTecnico::model()->find($criteria);

	$criteria = new CDbCriteria;
	$criteria->compare('Aluno_CDAluno',
	$modelRequerimento->Aluno_CDAluno);
	$modelAlunoGraduacao  = AlunoGraduacao::model()->find($criteria);

	$criteria = new CDbCriteria;
	$criteria->compare('CDAluno',
	$modelRequerimento->Aluno_CDAluno);
	$modelAluno  = Aluno::model()->find($criteria);



if(Yii::app()->user->checkAccess('graduacao') || Yii::app()->user->checkAccess('tecnico')){
	echo $this->renderPartial('//requerimentos/_formAlunoSimple', array('modelRequerimento'=>$modelRequerimento));
}
else{
	echo $this->renderPartial('//requerimentos/_formAluno', array('modelRequerimento'=>$modelRequerimento,'modelAlunoGraduacao'=>$modelAlunoGraduacao,'modelAlunoTecnico'=>$modelAlunoTecnico,'modelAluno'=>$modelAluno));
}
 echo $this->renderPartial('//requerimentos/_formOpcoesSimple', array('modelRequerimento'=>$modelRequerimento));

 echo $this->renderPartial('//requerimentos/_formSituacao', array('modelRequerimento'=>$modelRequerimento));

if($alterarSituacao){
	echo $this->renderPartial('//requerimentos/_formNovaSituacao', array('modelSituacaoRequerimento'=>$modelSituacaoRequerimento));
}


?>
<br /><br />
<?php
	$this->widget('bootstrap.widgets.TbButton', array(
	'type'=>'',
	'label'=>'Voltar',
	'url' => $url,
));
?>