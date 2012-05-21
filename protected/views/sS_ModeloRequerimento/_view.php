<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDModeloRequerimento')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDModeloRequerimento), array('view', 'id'=>$data->CDModeloRequerimento)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMModeloRequerimento')); ?>:</b>
	<?php echo CHtml::encode($data->NMModeloRequerimento); ?>
	<br />

		<b><?php echo CHtml::encode($data->getAttributeLabel('SgRequerimento')); ?>:</b>
		<?php echo CHtml::encode($data->SgRequerimento); ?>
		<br />
</div>