<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'empresa-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMEmpresa'); ?>
		<?php echo $form->textField($model,'NMEmpresa',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'AreaSetor'); ?>
		<?php echo $form->textField($model,'AreaSetor',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'AreaSetor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Responsavel'); ?>
		<?php echo $form->textField($model,'Responsavel',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Responsavel'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Telefone'); ?>
		<?php echo $form->textField($model,'Telefone',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'Telefone'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->