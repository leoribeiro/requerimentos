<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CDAluno'); ?>
		<?php echo $form->textField($model,'CDAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NMAluno'); ?>
		<?php echo $form->textField($model,'NMAluno',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'NumMatricula'); ?>
		<?php echo $form->textField($model,'NumMatricula',array('size'=>12,'maxlength'=>12)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Bairro'); ?>
		<?php echo $form->textField($model,'Bairro',array('size'=>25,'maxlength'=>25)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CEP'); ?>
		<?php echo $form->textField($model,'CEP',array('size'=>8,'maxlength'=>8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EnderecoRua'); ?>
		<?php echo $form->textField($model,'EnderecoRua',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EnderecoNumero'); ?>
		<?php echo $form->textField($model,'EnderecoNumero',array('size'=>7,'maxlength'=>7)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Telefone'); ?>
		<?php echo $form->textField($model,'Telefone',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DataNascimento'); ?>
		<?php echo $form->textField($model,'DataNascimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Sexo'); ?>
		<?php echo $form->textField($model,'Sexo',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->