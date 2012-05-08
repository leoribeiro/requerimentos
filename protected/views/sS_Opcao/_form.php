<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ss--opcao-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMOpcao'); ?>
		<?php echo $form->textField($model,'NMOpcao',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'NMOpcao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->