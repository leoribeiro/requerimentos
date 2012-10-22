<div class="wide form">


<fieldset>
<legend>Dados do Aluno</legend>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelRequerimento->relAluno,
	'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
	'attributes'=>array(
		'NMAluno',
		'NumMatricula',
	),
	
)); ?>
</fieldset>



</div><!-- form -->