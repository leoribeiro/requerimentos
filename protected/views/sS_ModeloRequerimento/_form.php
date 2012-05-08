<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ss--modelo-requerimento-form',
	'enableAjaxValidation'=>false,
)); 
//Remove variável de sessão responsável pelo controle das Disciplinas no Controller Turma
unset(Yii::app()->session['OpcoesEscolhidas']);
?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'NMModeloRequerimento'); ?>
		<?php echo $form->textField($model,'NMModeloRequerimento',array('size'=>60,'maxlength'=>60)); ?>
		<?php echo $form->error($model,'NMModeloRequerimento'); ?>
	</div>
	
		<div class="row">
		<table>
			<tr>
			<td width="25%">
			<?php echo $form->labelEx($model,'OpcoesDisponiveis'); ?>
				<?php $lista =CHtml::listData(SS_Opcao::model()->findAll(array('order'=>'NMOpcao')), 'CDOpcao', 'NMOpcao');
				echo CHtml::dropDownList('OpcoesDisponiveis[]','',$lista,
					array('multiple'=>'multiple',
			      	'size'=>15,
				  	'style'=>'width:340px')); ?>
				<br />
				<?php echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Nova Opção', array('title'=>'Nova Opção')), "",  // the link for open the dialog
				    array(
				        'style'=>'cursor: pointer; text-decoration: underline;',
				        'onclick'=>"{addOpcao(); $('#dialogOpcao').dialog('open');}"));?>
			</td>
			<td   width="2%">
				<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/item_ltr.png'),'Adicionar Opção'), 
				$this->createUrl('SS_ModeloRequerimento/AdicionaOpcao'),
				array(
					'type' =>'POST',
				    'update'=>'#SS_ModeloRequerimento_relOpcao', //selector to update
				)
				); ?>
				<br /><br />
				<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/item_rtl.png'),'Remover Disciplina'), 
				$this->createUrl('SS_ModeloRequerimento/RemoveOpcao'),
				array(
					'type' =>'POST',
				    'update'=>'#SS_ModeloRequerimento_relOpcao', //selector to update
				)
				); ?>
			</td>
			<td width="25%">
				<?php echo $form->labelEx($model,'relOpcao'); ?>
				<?php
				     	$resultado = SS_Opcao::model()->with('relModeloRequerimento')->findAll(
						 array('order'=>'NMOpcao','condition'=>'relModeloRequerimento.CDModeloRequerimento=:REQ',
					    'params'=>array(':REQ'=>$model->CDModeloRequerimento))); 
					
						//Trata as diciplinas em um update
					    $OpcoesEscolhidas = array();
					    foreach($resultado as $registro){
							$OpcoesEscolhidas[] = $registro->CDOpcao;
						}
						Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;
						//
						
						
				     $lista =CHtml::listData($resultado, 'CDOpcao', 'NMOpcao');
				     echo CHtml::activeDropDownList($model,'relOpcao',$lista,
					array('multiple'=>'multiple',
					      'size'=>15,
						  'style'=>'width:340px')); ?>
					


			</td>
			<td>
				<?php // echo $form->labelEx($model,'Relatorio'); ?>
				<div id="opcoesRelatorio"></div>
			</td>
			</tr>
		</table>
		
		
		<?php
		// Programação para o CjuiDIalog de Opção
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
		    'id'=>'dialogOpcao',
		    'options'=>array(
		        'title'=>'Nova opção',
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
		function addOpcao()
		{
		    <?php echo CHtml::ajax(array(
		            'url'=>array('SS_Opcao/create'),
		            'data'=> "js:$(this).serialize()",
		            'type'=>'post',
		            'dataType'=>'json',
		            'success'=>"function(data)
		            {
		                if (data.status == 'failure')
		                {
		                    $('#dialogOpcao div.divForForm').html(data.div);
		                          // Here is the trick: on submit-> once again this function!
		                    $('#dialogOpcao div.divForForm form').submit(addOpcao);
		                }
		                else
		                {
							".CHtml::ajax(array(
		                        'type'=>'POST',
	                               'url'=>CController::createUrl('/Site/JSONOpcaoRequerimento'),
	                               'update'=>'#OpcoesDisponiveis'
							))."
		                    $('#dialogOpcao div.divForForm').html(data.div);
		                    setTimeout(\"$('#dialogOpcao').dialog('close') \",3000);
		                }

		            } ",
		            ))?>;
		    return false; 

		}

		</script>
		
		</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Cadastrar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->