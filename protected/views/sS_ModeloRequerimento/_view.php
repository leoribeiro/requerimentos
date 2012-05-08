<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDModeloRequerimento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDModeloRequerimento), array('view', 'id'=>$data->CDModeloRequerimento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMModeloRequerimento')); ?>:</b>
	<?php echo CHtml::encode($data->NMModeloRequerimento); ?>
	<br />


</div>