<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}
</script>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'requerimento-opcoes-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'well'),
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
		asort($opcoes);
		$contOpcao = 1;
		if(sizeof($opcoes)%2==0){
			$contOpcao2 = (int)(sizeof($opcoes)/2)+1;
		}
		else{
			$contOpcao2 = (int)(sizeof($opcoes)/2)+2;
		}
		$par = false;
		foreach($opcoes as $key=>$value){
			if(!$par){
				$contOpcaoT = str_pad($contOpcao, 2, "0", STR_PAD_LEFT);
				$contOpcao++;
				$par = true;
			}
			else{
				$contOpcaoT = str_pad($contOpcao2, 2, "0", STR_PAD_LEFT);
				$contOpcao2++;
				$par = false;
			}
			$opcoes[$key] = $contOpcaoT." - ".$value;
		}
		echo $form->checkBoxList($modelRequerimento,'relOpcao',$opcoes,array(
		            'separator'=>'',
		            'template'=>'<div class="item">{input}{label}</div>',
		            ));
		if($modelModeloRequerimento->CDModeloRequerimento == 2){
			$tipoSC = 1;
		}
		else {
			$tipoSC = 2;
		}

	?>
</div>
<style>
.item {white-space: nowrap;display:inline  }
.checkboxgroup{
        overflow:auto;
}
.checkboxgroup div{
        width:100%;
        float:left;
}
</style>
</fieldset>

<div id="opcoesMore">
</div>

<fieldset>
	<legend>Observações</legend>
	<div class="row3">
	<p class="note">Adicionar Observações ou especificar o motivo.</p>
		<?php echo $form->textArea($modelRequerimento,'Observacoes',array('rows'=>6, 'span'=>'7','cols'=>110,'tabindex'=>9,'onKeyDown'=>"limitText(this.form.SS_Requerimento_Observacoes,this.form.countdown,500);", 
		'onKeyUp'=>"limitText(this.form.SS_Requerimento_Observacoes,this.form.countdown,500);")); ?>
		<p>Você tem <input readonly type="text" name="countdown" size="3" value="500" tabindex="46" > caracteres restantes.</p>
		<?php echo $form->error($modelRequerimento,'Observacoes'); ?>
	</div>
</fieldset>
<!--
<fieldset>
	<legend>Prazo para emissão dos documentos</legend>
	<div class="row3">
		<table>
					<tr><td><b>Documentos</b></td><td><b>Prazos</b></td></tr>
					<tr><td><div align="left">Declarações e Verificação de Pendências</div></td><td><div align="left">03 (três) dias úteis</div></td></tr>
					<tr><td><div align="left">Históricos e Ementas</div></td><td><div align="left">15 (quinze) dias corridos</div></td></tr>
					<tr><td><div align="left">Diplomas Técnico e Superior</div></td ><td><div align="left">Aproximadamente 1 (um) ano</div></td></tr>
		</table>
	</div>
</fieldset>
-->
<div align="center">
	<?php $this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'size'=>'large',
	'label'=>'Enviar Requerimento')); ?>
</div>


<?php $this->endWidget(); ?>

</div><!-- form -->


<script type="text/javascript" language="javascript">

	$(document).ready(function() { 

		$('input[type="checkbox"]').each(function(i) {
      		if(($(this).val() == 12 || $(this).val() == 31) && $(this).is(':checked')){
      			$("#opcoesMore").load("<? echo CController::createUrl('Requerimentos/SegundaChamada'); ?>", {'Tipo' : <? echo $tipoSC ?>});
      		}
    	});



	});

	$('input[type=checkbox]').change(function(){
		if($(this).val() == 12){
			if($(this).is(':checked')){
				$("#opcoesMore").load("<? echo CController::createUrl('Requerimentos/SegundaChamada'); ?>", {'Tipo' : <? echo $tipoSC ?>});
			}
			else{
				$("#opcoesMore").load(" ");
			}
		}
		if($(this).val() == 31){
			if($(this).is(':checked')){
				$("#opcoesMore").load("<? echo CController::createUrl('Requerimentos/CartaEstagio'); ?>");
			}
			else{
				$("#opcoesMore").load(" ");
			}	
		}	
	});

</script>