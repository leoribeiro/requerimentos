<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDEmpresa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDEmpresa), array('view', 'id'=>$data->CDEmpresa)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMEmpresa')); ?>:</b>
	<?php echo CHtml::encode($data->NMEmpresa); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('AreaSetor')); ?>:</b>
	<?php echo CHtml::encode($data->AreaSetor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Responsavel')); ?>:</b>
	<?php echo CHtml::encode($data->Responsavel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Telefone')); ?>:</b>
	<?php echo CHtml::encode($data->Telefone); ?>
	<br />


</div>