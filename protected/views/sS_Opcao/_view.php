<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDOpcao')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDOpcao), array('view', 'id'=>$data->CDOpcao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMOpcao')); ?>:</b>
	<?php echo CHtml::encode($data->NMOpcao); ?>
	<br />


</div>