<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDCurso')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDCurso), array('view', 'id'=>$data->CDCurso)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('NMCurso')); ?>:</b>
	<?php echo CHtml::encode($data->NMCurso); ?>
	<br />


</div>