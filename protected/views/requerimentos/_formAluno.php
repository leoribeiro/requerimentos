<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'requerimento-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
<fieldset>
<legend>Dados do Aluno</legend>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$modelAluno,
	'cssFile' => Yii::app()->baseUrl . '/css/gridReq.css',
	'attributes'=>array(
		'NMAluno',
		'NumMatricula',
		array(
			'label'=>'Curso',
			'value'=>$modelAlunoGraduacao->relCurso->NMCurso,
			'filter'=>false,
		),
		'Email',
		'CEP',
		'Bairro',
		'EnderecoRua',
		'EnderecoNumero',
		array(
			'label'=>'Cidade',
			'value'=>'Ipatinga - MG',
			'filter'=>false,
		),


	),
	
)); ?>
</fieldset>



<?php $this->endWidget(); ?>

</div><!-- form -->