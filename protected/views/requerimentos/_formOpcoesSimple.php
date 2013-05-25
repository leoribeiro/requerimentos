<div class="opcoesForm">
<div>
<fieldset>
<legend>Opção(ões) escolhida(das):</legend>
<div class="checkboxgroup">

	<?php
		$OpcoesFormulario = $modelRequerimento->relOpcao;
		$opcoes = array();
		foreach($OpcoesFormulario as $opcao){
			$opcoes[$opcao->CDOpcao] = $opcao->NMOpcao;
		}
		asort($opcoes);
		$contOpcao = 1;
		foreach($opcoes as $key=>$value){
			echo "<div class='textoForm'>".$contOpcao." - ".$value."</div><br />";
			$contOpcao++;
		}
	?>
</div>
</fieldset>
<?
if(!empty($modelRequerimento->Observacoes)){
?>
<fieldset>
	<legend>Observações</legend>
	<div class="row3">
		<?php echo "<div class='textoForm'>".$modelRequerimento->Observacoes,"</div>"; ?>

	</div>
</fieldset>
<br />
<?
}
?>

