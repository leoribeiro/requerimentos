<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDAluno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDAluno), array('view', 'id'=>$data->CDAluno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMAluno')); ?>:</b>
	<?php echo CHtml::encode($data->NMAluno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NumMatricula')); ?>:</b>
	<?php echo CHtml::encode($data->NumMatricula); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Bairro')); ?>:</b>
	<?php echo CHtml::encode($data->Bairro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CEP')); ?>:</b>
	<?php echo CHtml::encode($data->CEP); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EnderecoRua')); ?>:</b>
	<?php echo CHtml::encode($data->EnderecoRua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EnderecoNumero')); ?>:</b>
	<?php echo CHtml::encode($data->EnderecoNumero); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefone')); ?>:</b>
	<?php echo CHtml::encode($data->Telefone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DataNascimento')); ?>:</b>
	<?php echo CHtml::encode($data->DataNascimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Sexo')); ?>:</b>
	<?php echo CHtml::encode($data->Sexo); ?>
	<br />

	*/ ?>

</div>