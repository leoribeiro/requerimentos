<div class="opcoesForm">
<div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requerimento-opcoes-form',
	'enableAjaxValidation'=>false,
)); ?>
<fieldset>
<legend>Selecione a opção desejada</legend>

<div class="checkboxgroup">
	<?php
		$OpcoesFormulario = $modelModeloRequerimento->relOpcao;
		$opcoes = array();
		foreach($OpcoesFormulario as $opcao){
			$opcoes[$opcao->CDOpcao] = $opcao->NMOpcao;
		}
		echo "<table>"; //
		echo $form->checkBoxList($modelRequerimento,'relOpcao',$opcoes,array(
		            'separator'=>'',
		            'template'=>'<div class="opcao">{input}&nbsp;{label}</div>'
		            ));
		echo "</table>";
	
	
	?>
</div>


</fieldset>

<div align="center">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Enviar Requerimento' : 'Salvar',array('style'=>'width:500px;height:30px;font-size: 1.2em')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->