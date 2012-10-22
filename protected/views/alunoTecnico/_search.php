<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDAlunoTecnico'); ?>
		<?php echo $form->textField($model,'CDAlunoTecnico'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Aluno_CDAluno'); ?>
		<?php echo $form->textField($model,'Aluno_CDAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CursoTecnico_CDCurso'); ?>
		<?php echo $form->textField($model,'CursoTecnico_CDCurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Serie'); ?>
		<?php echo $form->textField($model,'Serie'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->