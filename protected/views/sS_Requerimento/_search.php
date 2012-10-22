<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDRequerimento'); ?>
		<?php echo $form->textField($model,'CDRequerimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
		<?php echo $form->textField($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Aluno_CDAluno'); ?>
		<?php echo $form->textField($model,'Aluno_CDAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Observacoes'); ?>
		<?php echo $form->textField($model,'Observacoes',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->