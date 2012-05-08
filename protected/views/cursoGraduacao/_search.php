<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDCurso'); ?>
		<?php echo $form->textField($model,'CDCurso'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMCurso'); ?>
		<?php echo $form->textField($model,'NMCurso',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->