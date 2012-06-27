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
		<?php 
		if(!empty($model->NumMatricula) and !(Yii::app()->user->name == 'admin')){
			echo $form->textField($model,'NumMatricula',array('size'=>12,
			'maxlength'=>12,'readonly'=>'readonly'));
		}
		else{
			echo $form->textField($model,'NumMatricula',array('size'=>12,'maxlength'=>12));
		}
		 ?>
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
			<?php $this->widget('CMaskedTextField',array(
                 'model'=>$model,
                 'attribute'=>'DataNascimento',
                 'mask'=>'99/99/9999',
                
             )); ?>
			<?php echo $form->error($model,'DataNascimento'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'Sexo'); ?>
			<?php echo $form->dropDownList($model, 'Sexo', array(''=>'', 'F' => 'F', 'M' => 'M')); ?>
			<?php echo $form->error($model,'Sexo'); ?>
		</div>
</fieldset>
<fieldset>
<legend>Filiação</legend>

	<div class="row">
		<?php echo $form->labelEx($model,'NMMae'); ?>
		<?php echo $form->textField($model,'NMMae',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMMae'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'NMPai'); ?>
		<?php echo $form->textField($model,'NMPai',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'NMPai'); ?>
	</div>

</fieldset>
<fieldset>
<legend>Endereço</legend>

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
	
	<div class="row">
		<?php echo $form->labelEx($model,'Bairro'); ?>
		<?php echo $form->textField($model,'Bairro',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'Bairro'); ?>
	</div>
	
		<div class="row">
		    <?php
				if(isset($model->Cidade_CDCidade)){

				    $dataEstado=Estado::model()->with('relCidade')->
				    find(array('condition'=>'relCidade.CDCidade=:CIDADE',
				    'params'=>array(':CIDADE'=>$model->Cidade_CDCidade)));
					$est = $dataEstado->CDEstado;
					$dataCidade=Cidade::model()->findAll(array('order'=>'NMCidade',
					'condition'=>'Estado_CDEstado=:ESTADO',
				    'params'=>array(':ESTADO'=>$est)));
					$listaCidade = CHtml::listData($dataCidade, 'CDCidade', 'NMCidade');

				}
				else {
					$est = 0;
					$listaCidade = array();
				}
		    ?>
			<?php echo $form->labelEx($model,'relCidade.Estado_CDEstado'); ?>
			<?php $lista = CHtml::listData(Estado::model()->findAll(), 'CDEstado', 'NMEstado');

			?>
			<?php echo CHtml::DropDownList('CDEstado','',$lista,
			array('empty'=>'Escolha um estado',
			'options' => array($est=>array('selected'=>true)),
			'style'=>'width:220px',
			'ajax' => array(
			'type'=>'POST', //request type
			'url'=>CController::createUrl('Aluno/AtualizaCidade'),
			'update'=>'#Aluno_Cidade_CDCidade', //selector to update
			))
			); ?>
			<?php echo $form->error($model,'relCidade.Estado_CDEstado'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'Cidade_CDCidade'); ?>
		<?php echo CHtml::activeDropDownList($model,'Cidade_CDCidade',$listaCidade,array('style'=>'width:220px')); ?>
			<?php echo $form->error($model,'Cidade_CDCidade'); ?>

		</div>
	
</fieldset>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>
		<br />
		<br />
<?php $this->endWidget(); ?>

</div><!-- form -->