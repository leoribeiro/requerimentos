<div class="wide form">


<fieldset>
<legend>Dados do Aluno</legend>
<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	'data'=>$modelRequerimento->relAluno,
	'type'=>'striped bordered',
	'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
	'attributes'=>array(
		'NMAluno',
		'NumMatricula',
	),
	
)); ?>
</fieldset>



</div><!-- form -->