<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="pt_BR" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<?//$this->widget('ext.widgets.googleAnalytics.EGoogleAnalyticsWidget',
	        //array('account'=>'UA-24595324-3','domainName'=>'sistemas.timoteo.cefetmg.br')
//	);?>
	
</head>


<?php
$hora = date("H"); 
if($hora >= 0 && $hora < 6) { 
	$comprimento = "Boa madrugada"; 
} 
else if ($hora >= 6 && $hora < 12){ 
	$comprimento = "Bom dia"; 
} 
else if ($hora >= 12 && $hora < 18) { 
	$comprimento = "Boa Tarde"; 
} 
else{ 
	$comprimento = "Boa noite"; }
	

	$hoje = getdate();

	// Nessa parte do código foi criada a variável $hoje, que receberá os valores da data.

	switch ($hoje['wday'])
	{
	   case 0:
	      $dataextenso = "Domingo, ";
	      break;
	   case 1:
	      $dataextenso = "Segunda-Feira, ";
	      break;
	   case 2:
	      $dataextenso = "Terça-Feira, ";
	      break;
	   case 3:
	      $dataextenso = "Quarta-Feira, ";
	      break;
	   case 4:
	      $dataextenso = "Quinta-Feira, ";
	      break;
	   case 5:
	      $dataextenso = "Sexta-Feira, ";
	      break;
	   case 6:
	      $dataextenso = "Sábado, ";
	      break;
	}

	// Acima foi utilizada a instrução switch para que o dia da semana possa ser apresentado por
	// extenso, já que o PHP retorna em números. Perceba que dentro de cada instrução case tem uma
	// instrução echo que escreve o dia da semana na tela.

	$dataextenso .= $hoje['mday'];

	// A instrução echo $hoje[‘mday’]; escreve na tela o data em número, 
	// conforme retorna o PHP, não precisando de conversão.

	switch ($hoje['mon'])
	{
	   case 1:
	      $dataextenso .=  " de Janeiro de ";
	      break;
	   case 2:
	      $dataextenso .=  " de Fevereiro de ";
	      break;
	   case 3:
	      $dataextenso .=  " de Março de ";
	      break;
	   case 4:
	      $dataextenso .=  " de Abril de ";
	      break;
	   case 5:
	      $dataextenso .=  " de Maio de ";
	      break;
	   case 6:
	      $dataextenso .=  " de Junho de ";
	      break;
	   case 7:
	      $dataextenso .=  " de Julho de ";
	      break;
	   case 8:
	      $dataextenso .=  " de Agosto de ";
	      break;
	   case 9:
	      $dataextenso .=  " de Setembro de ";
	      break;
	   case 10:
	      $dataextenso .=  " de Outubro de ";
	      break;
	   case 11:
	      $dataextenso .=  " de Novembro de ";
	      break;
	   case 12:
	      $dataextenso .=  " de Dezembro de ";
	      break;
	}

	// A parte do código acima tem a mesma função que o primeiro switch utilizado, 
	// só que agora ele é usado para apresentar o mês.

	$dataextenso .=  $hoje['year'].'.';


?>


<body>
<div id="main_container">
<div id="top_banner"><div id="logonti">
	<img src="<? echo $this->createUrl('/images/nti.png'); ?>" alt="" title="" border="0">
	<img src="<? echo $this->createUrl('/images/centro.png'); ?>" alt="" title="" border="0" >
	<img src="<? echo $this->createUrl('/images/cefet.png'); ?>" alt="" title="" border="0" >
</div></div></div>
<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::image($this->createUrl('/images/Titulo_5.png'),'Sistema de Requerimentos'); ?></div>
		<div id="subtitle">
			<?php echo CHtml::encode($comprimento.'! '.$dataextenso); ?>
		</div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/Site/index'),'visible'=>!Yii::app()->user->isGuest),
				array('label'=>'Administração', 'items'=>array(
					
						array('label'=>'Gerenciar requerimentos existentes', 
					'url'=>array('/SS_Requerimento/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
					
		            	array('label'=>'Cadastrar modelo de requerimento', 
						'url'=>array('/SS_ModeloRequerimento/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
						array('label'=>'Cadastrar opção de modelo de requerimento', 
						'url'=>array('/SS_Opcao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
						
						array('label'=>'Cadastrar curso técnico', 
						'url'=>array('/cursoTecnico/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
						array('label'=>'Cadastrar curso de graduação', 
						'url'=>array('/cursoGraduacao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),				
				),'visible'=>(Yii::app()->user->name == 'admin')),
				
		   // menu alunos
			array('label'=>'Alunos', 'items'=>array(
				
	            	array('label'=>'Alunos de graduação', 
					'url'=>array('/alunoGraduacao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
					array('label'=>'Alunos de curso técnico', 
					'url'=>array('/alunoTecnico/admin'),'visible'=>(Yii::app()->user->name == 'admin')),			
			),'visible'=>(Yii::app()->user->name == 'admin')),
			
			// menu Requerimentos
			array('label'=>'Meus Requerimentos', 'items'=>array(

	            	array('label'=>'Registro Escolar', 
					'url'=>array('/SS_RequerimentoAlunoRegistroEscolar/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
					array('label'=>'Técnico', 
					'url'=>array('/SS_RequerimentoAlunoRegistroEscolar/admin'),'visible'=>(Yii::app()->user->name == 'admin')),	
					array('label'=>'Graduação', 
					'url'=>array('/SS_RequerimentoAlunoRegistroEscolar/admin'),'visible'=>(Yii::app()->user->name == 'admin')),	
					array('label'=>'Estágio', 
					'url'=>array('/SS_RequerimentoAlunoRegistroEscolar/admin'),'visible'=>(Yii::app()->user->name == 'admin')),	
			),'visible'=>(Yii::app()->user->name == 'admin')),
				

				array('label'=>'Login', 'url'=>array('/Site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/Site/logout'), 'visible'=>!Yii::app()->user->isGuest)
				),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
	
		NTI - Núcleo de Tecnologia da Informação
		<br/>
		CEFET-MG Campus Timóteo - 2012<br/>
	</div>

</div><!-- page -->

</body>
</html>