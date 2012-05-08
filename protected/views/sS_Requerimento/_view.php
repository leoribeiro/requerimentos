<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDRequerimento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDRequerimento), array('view', 'id'=>$data->CDRequerimento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SS_ModeloRequerimento_CDModeloRequerimento')); ?>:</b>
	<?php echo CHtml::encode($data->SS_ModeloRequerimento_CDModeloRequerimento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Aluno_CDAluno')); ?>:</b>
	<?php echo CHtml::encode($data->Aluno_CDAluno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Observacoes')); ?>:</b>
	<?php echo CHtml::encode($data->Observacoes); ?>
	<br />


</div>