<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDAlunoTecnico')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDAlunoTecnico), array('view', 'id'=>$data->CDAlunoTecnico)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Aluno_CDAluno')); ?>:</b>
	<?php echo CHtml::encode($data->Aluno_CDAluno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CursoTecnico_CDCurso')); ?>:</b>
	<?php echo CHtml::encode($data->CursoTecnico_CDCurso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Serie')); ?>:</b>
	<?php echo CHtml::encode($data->Serie); ?>
	<br />


</div>