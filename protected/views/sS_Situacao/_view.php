<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDSituacao')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDSituacao), array('view', 'id'=>$data->CDSituacao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMsituacao')); ?>:</b>
	<?php echo CHtml::encode($data->NMsituacao); ?>
	<br />


</div>