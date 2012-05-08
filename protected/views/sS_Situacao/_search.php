<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDSituacao'); ?>
		<?php echo $form->textField($model,'CDSituacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMsituacao'); ?>
		<?php echo $form->textField($model,'NMsituacao',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->