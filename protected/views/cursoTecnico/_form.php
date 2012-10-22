<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'curso-tecnico-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMCurso'); ?>
		<?php echo $form->textField($model,'NMCurso',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'NMCurso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->