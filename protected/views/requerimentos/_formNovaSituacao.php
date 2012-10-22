<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requerimento-situacao-form',
	'enableAjaxValidation'=>false,
)); ?>
<fieldset>
<legend>Adicionar Situação</legend>

<div class="row">
	<?php echo $form->labelEx($modelSituacaoRequerimento,'SS_Situacao_CDSituacao'); ?>
	<?php 
	// não é ideal fazer todos esses sqls muito mais na camada de view. 
	// Melhorar isso aí
	$criteria = new CDbCriteria;
    $criteria->compare('SS_Requerimento_CDRequerimento',
    $modelSituacaoRequerimento->SS_Requerimento_CDRequerimento);
	$modelSR = SS_SituacaoRequerimento::model()->findAll($criteria);
	$situacoesNot = array();
	foreach($modelSR as $SR){
		$situacoesNot[] = $SR->SS_Situacao_CDSituacao;
	}
	$criteria = new CDbCriteria;
    $criteria->order = 'NMsituacao ASC' ;
	$criteria->addNotInCondition('CDSituacao',$situacoesNot);
	$lista =CHtml::listData(SS_Situacao::model()->findAll($criteria), 'CDSituacao', 'NMsituacao'); ?>
	<?php echo CHtml::activeDropDownList($modelSituacaoRequerimento,'SS_Situacao_CDSituacao',$lista,array('empty'=>'','style'=>'width:220px')); ?>
	<?php echo CHtml::link(CHtml::image($this->createUrl('images/b_newtbl.png'),'Nova situação', array('title'=>'Nova situação')), "",  // the link for open the dialog
	    array(
	        'style'=>'cursor: pointer; text-decoration: underline;',
	        'onclick'=>"{addSituacao(); $('#dialogSituacao').dialog('open');}"));?>
	<?php echo $form->error($modelSituacaoRequerimento,'SS_Situacao_CDSituacao'); ?>
	
</div>

<div class="row">
		<?php echo $form->labelEx($modelSituacaoRequerimento,'Observacoes'); ?>
		<?php echo $form->textArea($modelSituacaoRequerimento,'Observacoes',array('rows'=>6, 'cols'=>110,'tabindex'=>9)); ?>
		<?php echo $form->error($modelSituacaoRequerimento,'Observacoes'); ?>
	</div>
	
</fieldset>

<div align="center">
	<?php echo CHtml::submitButton($modelSituacaoRequerimento->isNewRecord ? 'Enviar Situação' : 'Salvar',array('style'=>'width:500px;height:30px;font-size: 1.2em')); ?>
</div>



		<?php
		// Programação para o CjuiDIalog da Situacao
		$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
		    'id'=>'dialogSituacao',
		    'options'=>array(
		        'title'=>'Nova situação',
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
		function addSituacao()
		{
		    <?php echo CHtml::ajax(array(
		            'url'=>array('SS_Situacao/create'),
		            'data'=> "js:$(this).serialize()",
		            'type'=>'post',
		            'dataType'=>'json',
		            'success'=>"function(data)
		            {
		                if (data.status == 'failure')
		                {
		                    $('#dialogSituacao div.divForForm').html(data.div);
		                          // Here is the trick: on submit-> once again this function!
		                    $('#dialogSituacao div.divForForm form').submit(addSituacao);
		                }
		                else
		                {
							".CHtml::ajax(array(
		                        'type'=>'POST',
                                'url'=>CController::createUrl('/Site/JSONSituacao'),
                                'update'=>'#SS_SituacaoRequerimento_SS_Situacao_CDSituacao'
							))."
		                    $('#dialogSituacao div.divForForm').html(data.div);
		                    setTimeout(\"$('#dialogSituacao').dialog('close') \",3000);
		                }

		            } ",
		            ))?>;
		    return false; 

		}

		</script>


<?php $this->endWidget(); ?>

</div><!-- form -->