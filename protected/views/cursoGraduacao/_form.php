<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'curso-graduacao-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMCurso'); ?>
		<?php echo $form->textField($model,'NMCurso',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMCurso'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastro' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->