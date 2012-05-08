<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aluno-form',
	'enableAjaxValidation'=>false,
)); ?>
<fieldset>
<legend>Dados do aluno</legend>

	<?php echo $form->errorSummary($model); ?>
	
	<?php
		echo $form->hiddenField($model,'CDAluno',array(
							'type'=>"hidden",
							'value'=>$model->CDAluno
		));
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMAluno'); ?>
		<?php echo $form->textField($model,'NMAluno',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMAluno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NumMatricula'); ?>
		<?php echo $form->textField($model,'NumMatricula',array('size'=>12,'maxlength'=>12)); ?>
		<?php echo $form->error($model,'NumMatricula'); ?>
	</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'Email'); ?>
			<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
			<?php echo $form->error($model,'Email'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'Telefone'); ?>
			<?php $this->widget('CMaskedTextField', array(
	                'model' => $model,
	                'attribute' => 'Telefone',
	                'mask' => '(99) 9999-9999',
	                'htmlOptions' => array('size' => 13)
	                )
		        ); ?>
			<?php echo $form->error($model,'Telefone'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'DataNascimento'); ?>
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		    	$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, 
					'attribute'=>'DataNascimento', 
					'mode'=>'date', 
					'language' => 'pt-BR',
		    	));
			?>
			<?php echo $form->error($model,'DataNascimento'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'Sexo'); ?>
			<?php echo $form->dropDownList($model, 'Sexo', array('empty'=>'', 'F' => 'F', 'M' => 'M')); ?>
			<?php echo $form->error($model,'Sexo'); ?>
		</div>
</fieldset>
<fieldset>
<legend>Endereço</legend>
	<div class="row">
		<?php echo $form->labelEx($model,'Bairro'); ?>
		<?php echo $form->textField($model,'Bairro',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'Bairro'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CEP'); ?>
		<?php echo $form->textField($model,'CEP',array('size'=>8,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'CEP'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EnderecoRua'); ?>
		<?php echo $form->textField($model,'EnderecoRua',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'EnderecoRua'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EnderecoNumero'); ?>
		<?php echo $form->textField($model,'EnderecoNumero',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'EnderecoNumero'); ?>
	</div>
</fieldset>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>
		<br />
		<br />
<?php $this->endWidget(); ?>

</div><!-- form -->