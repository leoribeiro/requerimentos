<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requerimento-num-form',
	'enableAjaxValidation'=>false,
)); ?>
<br />
<?php echo $form->errorSummary($modelRequerimento); ?>
<fieldset>
<legend>Número do Requerimento</legend>
<div class="row">
	<div class="textoForm"><?php echo $numRequerimento ?></div>
</div>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->