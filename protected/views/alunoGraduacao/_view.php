<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CDAlunoGraduacao')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CDAlunoGraduacao), array('view', 'id'=>$data->CDAlunoGraduacao)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Aluno_CDAluno')); ?>:</b>
	<?php echo CHtml::encode($data->Aluno_CDAluno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CursoGraduacao_CDCurso')); ?>:</b>
	<?php echo CHtml::encode($data->CursoGraduacao_CDCurso); ?>
	<br />


</div>