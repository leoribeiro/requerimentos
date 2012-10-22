<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ss--requerimento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
		<?php echo $form->textField($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
		<?php echo $form->error($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Aluno_CDAluno'); ?>
		<?php echo $form->textField($model,'Aluno_CDAluno'); ?>
		<?php echo $form->error($model,'Aluno_CDAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Observacoes'); ?>
		<?php echo $form->textField($model,'Observacoes',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'Observacoes'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->