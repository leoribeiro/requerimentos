<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Autenticação',
);
?>

<h1>Autenticação</h1>

<div class='msglogin'>
<div style="width: 4%; float: left;"><? echo CHtml::image($this->createUrl('images/professor.png'),''); ?></div>
<div style="width: 96%; float: left; vertical-align: middle;">
	<h4>Servidores</h4> Digitar como login a sua conta de e-mail seguido do caractere "underscore" e do grupo a que pertence.  Por exemplo, o usuario fulano@timoteo.cefetmg.br digitará como login fulano_timoteo e utilizará a senha do e-mail do CEFET-MG.   
	Para liberar o acesso ao sistema, entre em contato com o NTI. Tel: (31) 3845-4602 
</div>
<div style="clear: both;"></div>
</div>

<div class='msglogin'>
<div style="width: 4%; float: left;"><? echo CHtml::image($this->createUrl('images/aluno.png'),''); ?></div>
<div style="width: 96%; float: left;"><h4>Alunos</h4> Digitar como login e senha os mesmos utilizados no sistema Acadêmico.  
Se você não possuir acesso ao sistema, <a href="http://www.sinapse.cefetmg.br/jsp/ensino/pagina/manteratualizacaoalunoldap/autenticaraluno.jsf" target="_blank">clique aqui</a> e cadastre-se. </div>
<div style="clear: both;"></div>

</div>

<div class="form" align="center">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
<br />
	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('style'=>'width:200px')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('style'=>'width:200px')); ?>
		<?php echo $form->error($model,'password'); ?>
<!--		<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>
-->		
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Login'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
