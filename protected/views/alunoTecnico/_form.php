<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'aluno-tecnico-form',
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>
<legend>Dados do curso técnico</legend>

	<?php echo $form->errorSummary($model); ?>
	
	<?php
		echo $form->hiddenField($model,'Aluno_CDAluno',array(
							'type'=>"hidden",
							'value'=>$model->Aluno_CDAluno
			));
	?>

	
	<div class="row">
		<?php echo $form->labelEx($model,'CursoTecnico_CDCurso'); ?>
		<?php $lista =CHtml::listData(CursoTecnico::model()->findAll(array('order'=>'NMCurso')), 'CDCurso', 'NMCurso'); ?>
		<?php echo CHtml::activeDropDownList($model,'CursoTecnico_CDCurso',$lista,array('empty'=>'','style'=>'width:220px')); ?>
		<?php echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Novo curso', array('title'=>'Novo curso')), "",  // the link for open the dialog
		    array(
		        'style'=>'cursor: pointer; text-decoration: underline;',
		        'onclick'=>"{addCurso(); $('#dialogCurso').dialog('open');}"));?>
		<?php echo $form->error($model,'CursoTecnico_CDCurso'); ?>
	</div>
	
	<?php
	// Programação para o CjuiDIalog do Curso
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
	    'id'=>'dialogCurso',
	    'options'=>array(
	        'title'=>'Novo curso técnico',
	        'autoOpen'=>false,
	        'modal'=>true,
	        'width'=>550,
	        'height'=>200,
	    ),
	));?>
	<div class="divForForm"></div>

	<?php $this->endWidget();?>

	<script type="text/javascript">
	// here is the magic
	function addCurso()
	{
	    <?php echo CHtml::ajax(array(
	            'url'=>array('cursoTecnico/create'),
	            'data'=> "js:$(this).serialize()",
	            'type'=>'post',
	            'dataType'=>'json',
	            'success'=>"function(data)
	            {
	                if (data.status == 'failure')
	                {
	                    $('#dialogCurso div.divForForm').html(data.div);
	                          // Here is the trick: on submit-> once again this function!
	                    $('#dialogCurso div.divForForm form').submit(addCurso);
	                }
	                else
	                {
						".CHtml::ajax(array(
	                        'type'=>'POST',
                               'url'=>CController::createUrl('/Site/JSONCursoTecnico'),
                               'update'=>'#AlunoTecnico_CursoTecnico_CDCurso'
						))."
	                    $('#dialogCurso div.divForForm').html(data.div);
	                    setTimeout(\"$('#dialogCurso').dialog('close') \",3000);
	                }

	            } ",
	            ))?>;
	    return false; 

	}

	</script>

	<div class="row">
		<?php echo $form->labelEx($model,'Serie'); ?>
		<?php echo $form->dropDownList($model, 'Serie', array('empty'=>'', '1' => '1', '2' => '2', '3' => '3', '4' => '4')); ?>
		<?php echo $form->error($model,'Serie'); ?>
	</div>
	
		<div class="row">
			<?php echo $form->labelEx($model,'Turma_CDTurma'); ?>
					<?php $lista =CHtml::listData(Turma::model()->findAll(array('order'=>'NMTurma')), 'CDTurma', 'NMTurma'); ?>
			<?php echo $form->dropDownList($model, 'Turma_CDTurma', $lista); ?>
			<?php echo $form->error($model,'Turma_CDTurma'); ?>
		</div>

</fieldset>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

	<br />
	<br />

<?php $this->endWidget(); ?>

</div><!-- form -->