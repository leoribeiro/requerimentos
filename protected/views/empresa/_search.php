<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDEmpresa'); ?>
		<?php echo $form->textField($model,'CDEmpresa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMEmpresa'); ?>
		<?php echo $form->textField($model,'NMEmpresa',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'AreaSetor'); ?>
		<?php echo $form->textField($model,'AreaSetor',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Responsavel'); ?>
		<?php echo $form->textField($model,'Responsavel',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Telefone'); ?>
		<?php echo $form->textField($model,'Telefone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->