<?php

require_once(dirname(dirname(__FILE__)).'/components/ConfigApp.php');

$configPam = new ConfigApp();
$host = $configPam->host;
$usuario = $configPam->usuario;
$password = $configPam->password;
$basedados = $configPam->basedados;
$smtp = $configPam->smtp;
$userSmtp = $configPam->userSmtp;
$passSmtp = $configPam->passSmtp;


Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'language' => 'pt_br',
	'sourceLanguage' => 'pt_br',
	'defaultController'=>'site',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Requerimentos',

	// preloading 'log' component
	'preload'=>array('log','bootstrap'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.CAdvancedArBehavior',
		'MarcacaoProva.models.Disciplina',
		'MarcacaoProva.models.Departamento',
		'MarcacaoProva.models.Turma',
		'MarcacaoProva.models.SenhaServidor',
		'MarcacaoProva.components.Randomness',
		//'MarcacaoProva.components.UserIdentity',
		//'MarcacaoProva.components.UsuarioSistema',
		'RecursosHumanos.models.Estado',
		'RecursosHumanos.models.Cidade',
		'RecursosHumanos.models.Servidor',
		'RecursosHumanos.models.Usuario',
		'RecursosHumanos.models.Coordenacao',
		'RecursosHumanos.models.Professor',
		'RecursosHumanos.models.ProfessorEfetivo',
		'RecursosHumanos.models.ProfessorSubstituto',
		'RecursosHumanos.models.TecnicoAdministrativo',
		'RecursosHumanos.models.RH_ServidorStatus',
		'application.extensions.yii-mail.*',
		'application.modules.auditTrail.models.AuditTrail',

	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
			'ipFilters'=>array('127.0.0.1','::1'),
		),

		'auditTrail'=>array(
					'userClass' => 'UsuarioSistema',
					'userIdColumn' => 'CDUsuario',
					'userNameColumn' => 'NMUsuario',
				),
	),

	'theme'=>'bootstrap',

	// application components
	'components'=>array(

		'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),

		'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		            'host'=>$smtp,
		            'username'=>$userSmtp,
		            'password'=>$passSmtp,
		            'port'=>'25',
		            //'encryption'=>'ssl',
		            ),
		        'viewPath' => 'application.views.mail',
		        'logging' => true,
		        'dryRun' => false
		  ),

		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class' => 'WebUser',
		),

		'urlManager'=>array(
		     'urlFormat'=>'path',
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
					'<action:(login|logout|page|contact)>' => 'site/<action>',
				),
		     'showScriptName'=>false,
		),
		// uncomment the following to use a MySQL database

		'db'=>array(
			'connectionString' => 'mysql:host='.$host.';dbname='.$basedados,
			'emulatePrepare' => true,
			'username' => $usuario,
			'password' => $password,
			'charset' => 'utf8',
		),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'log' => array(
	            'class' => 'CLogRouter',
	            'routes' => array(
	                array(
	                    'class' => 'CFileLogRoute',
	                    'levels' => 'error, warning, trace, profile, info',
	                    'enabled' => true,
						'filter' => array(
		                    'class' => 'CLogFilter',
		                    'prefixSession' => true,
		                    'prefixUser' => false,
		                    'logUser' => false,
		                    'logVars' => array(),
		                ),
	              ),
	          ),
	     ),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'leoribeiro@timoteo.cefetmg.br',
		'defaultPageSize'=>50,
	),
);
