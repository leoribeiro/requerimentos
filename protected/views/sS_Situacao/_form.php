<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ss--situacao-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMsituacao'); ?>
		<?php echo $form->textField($model,'NMsituacao',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'NMsituacao'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->