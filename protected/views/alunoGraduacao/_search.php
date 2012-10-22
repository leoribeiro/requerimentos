<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDAlunoGraduacao'); ?>
		<?php echo $form->textField($model,'CDAlunoGraduacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Aluno_CDAluno'); ?>
		<?php echo $form->textField($model,'Aluno_CDAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CursoGraduacao_CDCurso'); ?>
		<?php echo $form->textField($model,'CursoGraduacao_CDCurso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->