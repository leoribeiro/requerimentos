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
		<?php echo $form->textField($model,'NMModeloRequerimento',array('size'=>80,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NMModeloRequerimento'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'SgRequerimento'); ?>
		<?php echo $form->textField($model,'SgRequerimento',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->error($model,'SgRequerimento'); ?>
	</div>
	
		<div class="row">
		<table>
			<tr>
			<td width="25%" style="float: left;display:table-cell;padding:5px;vertical-align:top;">
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
				$this->createUrl('SS_ModeloRequerimento/AdicionaOpcao2Versao'),
				array(
					'type' =>'POST',
				    'update'=>'#opcoesRel', //selector to update
				)
				); ?>
				<br /><br />
				<?php echo CHtml::ajaxLink(CHtml::image($this->createUrl('images/item_rtl.png'),'Remover Disciplina'), 
				$this->createUrl('SS_ModeloRequerimento/RemoveOpcao2Versao'),
				array(
					'type' =>'POST',
				    'update'=>'#opcoesRel', //selector to update
				)
				); ?>
			</td>
			<td width="45%" style="float: left;display:table-cell;padding:5px;vertical-align:top;">
				<?php echo $form->labelEx($model,'relOpcao'); ?>
				<br />
				<div id="opcoesRel">
				<?php
				
						$criteria = new CDBCriteria;
						$criteria->with =
						array('relModeloRequerimento','Opcao_ModeloRequerimento');
						$criteria->together = true;
						$criteria->order = 'NMOpcao';
						$criteria->compare('relModeloRequerimento.CDModeloRequerimento',
						$model->CDModeloRequerimento);
						$criteria->compare
						('Opcao_ModeloRequerimento.SS_Requerimento_CDRequerimento',
						$model->CDModeloRequerimento);
						
						$resultado = SS_Opcao::model()->findAll($criteria);

						//Trata as diciplinas em um update
					    $OpcoesEscolhidas = array();
					    $OpcoesEscolhidasPDF = array();
					    foreach($resultado as $registro){
							$OpcoesEscolhidas[] = $registro->CDOpcao;	
							//gambiarra, não tenho tempo para analisar, favor olhar.
							foreach($registro->Opcao_ModeloRequerimento as $req){
								$op = $req->GerarRequerimentoImpresso;
							}
							$OpcoesEscolhidasPDF[] = $op;

						}
						Yii::app()->session['OpcoesEscolhidas'] = $OpcoesEscolhidas;

						$lista =CHtml::listData($resultado, 'CDOpcao', 'NMOpcao');

						$x=1;
					    foreach($lista as $key=>$registro){
							if($x % 2){
								echo "<div style='background-color: #e5f1f4;'>";
								echo CHtml::Checkbox('OpcaoEsc'.$key). " ".$registro;
								echo "</div>";
							}
							else{
								echo "<div>";
								echo CHtml::Checkbox('OpcaoEsc'.$key). " ".$registro;
								echo "</div>";								
							}
							$x++;
						}						

					    //echo CHtml::activeCheckBoxList($model,'Opcoes', $lista); 
				     //$lista =CHtml::listData($resultado, 'CDOpcao', 'NMOpcao');
				   //echo CHtml::activeDropDownList($model,'relOpcao',$lista,
					//array('multiple'=>'multiple',
					 //    'size'=>15,
					//	  'style'=>'width:340px')); 
				
						
			?>
			</div>		


			</td>
			<td style="float: left;display:table-cell;padding:5px;vertical-align:top;">
		
		    	<?php echo $form->labelEx($model,'Relatorio'); ?>
		        <br />
			<div id="opcoesPDF">
				<?php 			
				
					$x=1;
				    foreach($lista as $key=>$registro){
						if($x % 2){
							echo "<div style='background-color: #e5f1f4;'>";
						}
						else{
							echo "<div>";
						}
						if($OpcoesEscolhidasPDF[$x-1] == 1){
							echo CHtml::Checkbox('OpcaoEscPDF'.$key,true). " Sim";
						}
						else{
							echo CHtml::Checkbox('OpcaoEscPDF'.$key,false). " Sim";
						}
						
						echo "</div>";
						$x++;
					}
				?>
		   </div>
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

	<script type="text/javascript" language="javascript">
	$('body').on('click','#yt0',function(){jQuery.ajax({'type':'POST','url':'<? echo CController::createUrl('SS_ModeloRequerimento/AdicionaOpcao2VersaoPDF'); ?>','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#opcoesPDF").html(html)}});return false;});
	$('body').on('click','#yt1',function(){jQuery.ajax({'type':'POST','url':'<? echo CController::createUrl('SS_ModeloRequerimento/RemoveOpcao2VersaoPDF'); ?>','cache':false,'data':jQuery(this).parents("form").serialize(),'success':function(html){jQuery("#opcoesPDF").html(html)}});return false;});

	</script>