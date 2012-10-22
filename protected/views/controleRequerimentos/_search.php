<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<div class="row">
	<?php echo $form->labelEx($model,'relRequerimento.relSituacao'); ?>
	<?php 
	$criteria = new CDbCriteria;
	$criteria->order = 'NMsituacao';
	$modelSituacao = SS_Situacao::model()->findAll($criteria);
	$lista = CHtml::listData($modelSituacao,'CDSituacao', 'NMsituacao');
	echo CHtml::activeDropDownList($model,'situacaoCDSituacao',$lista,
		array('empty'=>'Escolha a situação', 'style'=>'width:250px'));
 	?>
</div>

<div class="row">
			<?php echo $form->labelEx($model,
			'relRequerimento.Situacao_Requerimento.DataHora'); ?>
			<?php Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
		    	$this->widget('CJuiDateTimePicker',array(
					'model'=>$model, 
					'attribute'=>'DtPedido', 
					'mode'=>'date', 
					'language' => 'pt-BR',
		    	));
			?>
		</div>

<div class="row buttons">
	<?php echo CHtml::submitButton('Pesquisar'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->