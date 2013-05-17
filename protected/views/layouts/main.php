<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title>Sistema de Requerimentos</title>
</head>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/RequerimentosOnline.png','Sistema de Planos Acadêmicos',array('title'=>'Sistema de Controle de Documentos')); ?></div>
		<div id="subtitle">
			<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/cefet.jpg','CEFET-MG Campus Timóteo',array('title'=>'CEFET-MG Campus Timóteo')); ?>
		</div>
	</div><!-- header -->
		<?php
		if(Yii::app()->user->checkAccess('aluno')){
			$reqNM = 'Meus requerimentos';
		}
		else{
			$reqNM = 'Requerimentos';
		}
		if(Yii::app()->user->checkAccess('admin')){
			$isAdmin = true;
		}
		else{
			$isAdmin = false;
		}
		$this->widget('bootstrap.widgets.TbMenu',array(
			'type'=>'tabs',
	    	'stacked'=>false,
			'items'=>array(
				array('label'=>'Início', 'url'=>array('/Site/index'),'visible'=>(!Yii::app()->user->isGuest)),
				array('label'=>'Administração', 'items'=>array(
	        			array('label'=>'Modelos de requerimento', 'url'=>array('/SS_ModeloRequerimento/admin')),
	        			array('label'=>'Definir permissões', 'url'=>array('/SS_ModeloRequerimento/createResp')),
		            	array('label'=>'Gerenciar permissões', 'url'=>array('/SS_ModeloRequerimento/adminResp')),
						array('label'=>'Opções de requerimento', 'url'=>array('/SS_Opcao/admin')),
		            	array('label'=>'Gerenciar situações', 'url'=>array('/SS_Situacao/admin')),
						array('label'=>'Cursos técnicos', 'url'=>array('/cursoTecnico/admin')),
						array('label'=>'Cursos de graduação', 'url'=>array('/cursoGraduacao/admin')),
				),'visible'=>$isAdmin),
				array('label'=>$reqNM, 'items'=>array(
	        			array('label'=>'Registro Escolar', 'url'=>array('/Requerimentos/admin','Req'=>'RR')),
	        			array('label'=>'Área Técnica', 'url'=>array('/Requerimentos/admin','Req'=>'RT')),
		            	array('label'=>'Área Formação Geral', 'url'=>array('/Requerimentos/admin','Req'=>'RF')),
						array('label'=>'Graduação', 'url'=>array('/Requerimentos/admin','Req'=>'RG')),
		            	array('label'=>'Estágio', 'url'=>array('/Requerimentos/admin','Req'=>'RE')),
				),'visible'=>$isAdmin),
				array('label'=>'Alunos', 'items'=>array(
	        			array('label'=>'Alunos de curso técnico', 'url'=>array('/alunoTecnico/admin')),
	        			array('label'=>'Alunos de graduação', 'url'=>array('/alunoGraduacao/admin')),
				),'visible'=>$isAdmin),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
		))); ?>

	<?php echo $content; ?>

	<div id="footer">
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/nti.jpg', 'Núcleo de Tecnologia da Informação',array('title'=>'Núcleo de Tecnologia da Informação (nti@timoteo.cefetmg.br)')); ?>
		<br />
		<strong>NTI - Núcleo de Tecnologia da Informação</strong> <br />

		CEFET-MG Campus Timóteo - <?php echo date('Y'); ?> <br />
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>