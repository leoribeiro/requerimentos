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
	
	<?$this->widget('ext.widgets.googleAnalytics.EGoogleAnalyticsWidget',
	        array('account'=>'UA-24595324-4','domainName'=>'sistemas.timoteo.cefetmg.br')	);?>
	
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

	if(!is_null(Yii::app()->user->getModelAluno())){
		if(isset(Yii::app()->user->getModelAluno()->CDAluno)){
		   $id = Yii::app()->user->getModelAluno()->CDAluno;	
		}
		else{
		   $id=-1;
		}
			
		$menuReq = 'Meus Requerimentos';
	}
	else{
		$id = 0;

		$menuReq = "Requerimentos";
	}
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
				array('label'=>'Home', 'url'=>array('/Site/index'),'visible'=>(!Yii::app()->user->isGuest and $id!=-1)),
				array('label'=>'Administração', 'items'=>array(
					
		            	array('label'=>'Cadastrar modelo de requerimento', 
						'url'=>array('/SS_ModeloRequerimento/admin'),'visible'=>(Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRR() or Yii::app()->user->getPermRT() or Yii::app()->user->getPermRG() or Yii::app()->user->getPermRE() or Yii::app()->user->getPermRF())),
						array('label'=>'Definir permissões para os requerimentros', 
						'url'=>array('/SS_ModeloRequerimento/createResp'),'visible'=>(Yii::app()->user->name == 'admin')),
						array('label'=>'Gerenciar permissões para os requerimentros', 
						'url'=>array('/SS_ModeloRequerimento/adminResp'),'visible'=>(Yii::app()->user->name == 'admin')),
						
						array('label'=>'Cadastrar opção de modelo de requerimento', 
						'url'=>array('/SS_Opcao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
						
						array('label'=>'Gerenciar Situações', 
					'url'=>array('/SS_Situacao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),	
						array('label'=>'Cadastrar curso técnico', 
						'url'=>array('/cursoTecnico/admin'),'visible'=>(Yii::app()->user->name == 'admin')),
						array('label'=>'Cadastrar curso de graduação', 
	'url'=>array('/cursoGraduacao/admin'),'visible'=>(Yii::app()->user->name == 'admin')),			
	
	array('label'=>'Log de alteração no Banco de Dados', 
'url'=>array('/auditTrail/admin'),'visible'=>(Yii::app()->user->name == 'admin')),

	
				),'visible'=>(Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRR() or Yii::app()->user->getPermRT() or Yii::app()->user->getPermRG() or Yii::app()->user->getPermRE() or Yii::app()->user->getPermRF())),
				
				
				// meus dados
				
				array('label'=>'Meus dados', 'items'=>array(
					
						array('label'=>'Dados do aluno', 
					    'url'=>array('/aluno/view?id='.$id)),				
				),'visible'=>(!is_null(Yii::app()->user->getModelAluno()) and $id!=-1)),
				
				
			
			// menu Requerimentos
			array('label'=>$menuReq, 'items'=>array(

	            	array('label'=>'Registro Escolar', 
					'url'=>array('/Requerimentos/admin?Req=RR'),'visible'=>(Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRR() or !is_null(Yii::app()->user->getModelAluno()))),
					array('label'=>'Técnico - Área Técnica', 
					'url'=>array('/Requerimentos/admin?Req=RT'),'visible'=>(Yii::app()->user->getTipoAluno() == 1 or Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRT())),
					array('label'=>'Técnico - Área Formação Geral', 
					'url'=>array('/Requerimentos/admin?Req=RF'),'visible'=>(Yii::app()->user->getTipoAluno() == 1 or Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRF())),	
					array('label'=>'Graduação', 
					'url'=>array('/Requerimentos/admin?Req=RG'),'visible'=>(Yii::app()->user->getTipoAluno() == 2 or Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRG())),	
					array('label'=>'Estágio', 
					'url'=>array('/Requerimentos/admin?Req=RE'),'visible'=>(Yii::app()->user->name == 'admin' or Yii::app()->user->getPermRE() or !is_null(Yii::app()->user->getModelAluno()))),	
			),'visible'=>(!Yii::app()->user->isGuest and $id!=-1)),
			
			
			// menu alunos
			array('label'=>'Alunos', 'items'=>array(

	            	array('label'=>'Alunos de graduação', 
					'url'=>array('/alunoGraduacao/admin')),
					array('label'=>'Alunos de curso técnico', 
					'url'=>array('/alunoTecnico/admin')),			
			),'visible'=>(Yii::app()->user->name == 'admin' or Yii::app()->user->getModelServidor() != null)),
				

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