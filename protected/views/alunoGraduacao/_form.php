<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'aluno-graduacao-form',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>
<legend>Dados da graduação</legend>
	<?php echo $form->errorSummary($model); ?>

	<?php
		echo $form->hiddenField($model,'Aluno_CDAluno',array(
							'type'=>"hidden",
							'value'=>$model->Aluno_CDAluno
			));
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'CursoGraduacao_CDCurso'); ?>
		<?php $lista =CHtml::listData(CursoGraduacao::model()->findAll(array('order'=>'NMCurso')), 'CDCurso', 'NMCurso'); ?>
		<?php echo CHtml::activeDropDownList($model,'CursoGraduacao_CDCurso',$lista,array('empty'=>'','style'=>'width:220px')); ?>
		<?php //echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Novo curso', array('title'=>'Novo curso')), "",  // the link for open the dialog
		//    array(
		//        'style'=>'cursor: pointer; text-decoration: underline;',
		//        'onclick'=>"{addCurso(); $('#dialogCurso').dialog('open');}"));?>
		<?php echo $form->error($model,'CursoGraduacao_CDCurso'); ?>
	</div>
	
	
		<?php
		// Programação para o CjuiDIalog do Curso
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
		    'id'=>'dialogCurso',
		    'options'=>array(
		        'title'=>'Novo curso de graduação',
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
		            'url'=>array('cursoGraduacao/create'),
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
                                'url'=>CController::createUrl('/Site/JSONCursoGraduacao'),
                                'update'=>'#AlunoGraduacao_CursoGraduacao_CDCurso'
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
			<?php echo $form->labelEx($model,'Periodo'); ?>
			<?php echo $form->DropDownList($model,'Periodo',array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10')); ?>
			<?php echo $form->error($model,'Periodo'); ?>
		</div>

</fieldset>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'size'=>'large',
		'type'=>'primary',
		'label'=>'Salvar'));
	?>
<br />
<br />
<?php $this->endWidget(); ?>

</div><!-- form -->