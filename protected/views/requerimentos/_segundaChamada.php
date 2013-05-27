<br />
<div class="wide form">
		<fieldset>
		<legend>Segunda Chamada de Prova ministrada</legend>
		<div class="row">
			<?php echo CHtml::label('Professor','Professor',array('required'=>true)); ?>
			<?php echo CHtml::dropDownList('Professor','', $dataP, 
			array('style'=>'width:220px','prompt'=>'')); ?>
		</div>
		<div class="row">
			<?php echo CHtml::label('Disciplina','Disciplina',array('required'=>true)); ?>
			<?php echo CHtml::dropDownList('Disciplina','', $data, 
			array('style'=>'width:220px','prompt'=>'')); ?>
		</div>
		<div class="row">

			<?php echo CHtml::label('Data da avaliação perdida','DataProva',array('required'=>true)); ?>
			<?php 
			Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
	    	$this->widget('CJuiDateTimePicker',array(
				'name'=>'DataProva', 
				'mode'=>'date',
				'options'=>array("dateFormat"=>'dd/mm/yy'), 
				'language' => '',
	    	));
			?>
		</div>
		</fieldset>
</div>