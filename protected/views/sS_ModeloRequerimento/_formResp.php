<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ss--modelo-requerimento-resp-form',
	'enableAjaxValidation'=>false,
)); 

 //Remove variável de sessão responsável pelo controle dos servidores no Controller SS_ModeloRequerimento
 unset(Yii::app()->session['ServidoresEscolhidos']);

?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
        <?php echo CHtml::activeDropDownList($model,
	    'SS_ModeloRequerimento_CDModeloRequerimento',$listaMR); ?>
		<?php echo $form->error($model,'SS_ModeloRequerimento_CDModeloRequerimento'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'CursoTecnico_CDCurso'); ?>
        <?php echo CHtml::activeDropDownList($model,
	    'CursoTecnico_CDCurso',$listaCT,array('style'=>'width:200px','empty'=>'')); ?>
		<?php echo $form->error($model,'CursoTecnico_CDCurso'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'CursoGraduacao_CDCurso'); ?>
        <?php echo CHtml::activeDropDownList($model,
	    'CursoGraduacao_CDCurso',$listaCS,array('style'=>'width:200px','empty'=>'')); ?>
		<?php echo $form->error($model,'CursoGraduacao_CDCurso'); ?>
	</div>
	
<div class="row">
<table>
	<tr>
	<td width="15%">

	<?php echo $form->labelEx($model,'Servidores'); ?>
	<?php 
	    $lista = array("Professor Efetivo","Professor Substituto","Tecnico Administrativo");
	    echo CHtml::DropDownList('Cargo','',$lista,
		array('empty'=>'Escolha uma opção',
			  'style'=>'width:200px',
			  'ajax' => array(
			  'type'=>'POST', 
			  'url'=>CController::createUrl('SS_ModeloRequerimento/UpdateServidores'), 
			  'update'=>'#ServidoresDisponiveis', 
			  ))
	); 
	?>
	<br />
	<?php 
	    echo CHtml::dropDownList('ServidoresDisponiveis[]','',$listaServ,
		array('multiple'=>'multiple',
      	'size'=>15,
	  	'style'=>'width:200px')); ?>

    </div>
	</td>
	<td width="3%">
		<?php echo CHtml::ajaxLink(
			CHtml::image($this->createUrl('images/item_ltr.png'),
			'Adicionar Servidor'), 
		$this->createUrl('SS_ModeloRequerimento/AdicionaServidor'),
		array(
			'type' =>'POST',
		    'update'=>'#ServidoresEscolhidos', 
		)
		); ?>
		<br /><br />
		<?php echo CHtml::ajaxLink(
			CHtml::image($this->createUrl('images/item_rtl.png'),
			'Remover Servidor'), 
		$this->createUrl('SS_ModeloRequerimento/RemoveServidor'),
		array(
			'type' =>'POST',
		    'update'=>'#ServidoresEscolhidos', 
		)
		); ?>

	</td>
	<td >
		<?php echo $form->labelEx($model,'ServEscolhido'); ?>
		<?php
		echo CHtml::DropDownList('ServidoresEscolhidos[]','',array(),
		array('multiple'=>'multiple',
		      'size'=>17,
			  'style'=>'width:200px')); ?>

	</td>
	</tr>
</table>
</div>	
	<div class="row buttons">
			<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>$model->isNewRecord ? 'Salvar' : 'Salvar',
	)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->