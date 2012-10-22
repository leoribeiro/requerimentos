<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDOpcao'); ?>
		<?php echo $form->textField($model,'CDOpcao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMOpcao'); ?>
		<?php echo $form->textField($model,'NMOpcao',array('size'=>60,'maxlength'=>60)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->