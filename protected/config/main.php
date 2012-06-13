<?php


// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

// $projetoMarcacao = 'marcacaoprovas';
// $projetoRH = 'recursoshumanos';



return array(
	'language' => 'pt_br',
	'sourceLanguage' => 'pt_br',
	'defaultController'=>'site',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Sistema de Requerimentos',

	// preloading 'log' component
	'preload'=>array('log','session'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.CAdvancedArBehavior',
		'MarcacaoProva.models.Disciplina',
		'MarcacaoProva.models.Departamento',
		'MarcacaoProva.models.Turma',
		'MarcacaoProva.models.LoginForm',
		'MarcacaoProva.models.SenhaServidor',
		'MarcacaoProva.components.Randomness',
		'MarcacaoProva.components.UserIdentity',
		'MarcacaoProva.components.UsuarioSistema',
		'RecursosHumanos.models.Estado',
		'RecursosHumanos.models.Cidade',
		'RecursosHumanos.models.Servidor',
		'RecursosHumanos.models.Usuario',
		'RecursosHumanos.models.Professor',
		'RecursosHumanos.models.ProfessorEfetivo',
		'RecursosHumanos.models.ProfessorSubstituto',
		'RecursosHumanos.models.TecnicoAdministrativo',	
		// para a extensão rights
		'application.modules.rights.*', 
		'application.modules.rights.components.*',
		'application.extensions.yii-mail.*',
		'application.modules.auditTrail.models.AuditTrail',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'admin',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			// 'generatorPaths'=>array(
			//             'bootstrap.gii', // since 0.9.1
			// ),
		),
		
		'auditTrail'=>array(
					'userClass' => 'UsuarioSistema', 
					'userIdColumn' => 'CDUsuario', 
					'userNameColumn' => 'NMUsuario', 
				),
		
		'rights'=>array(
			'userClass' => 'Usuario',
			'superuserName' => 'admin',
			'userIdColumn'=>'CDUsuario',
			'userNameColumn'=>'NMUsuario',
			//'layout'=>'rights.views.layouts.main', 
			//'appLayout'=>'application.views.layouts.main',
			//'install'=>true,
		),
		
	),

	// application components
	'components'=>array(
		
		'mail' => array(
		        'class' => 'application.extensions.yii-mail.YiiMail',
		        'transportType'=>'smtp', /// case sensitive!
		        'transportOptions'=>array(
		            'host'=>'smtp.timoteo.cefetmg.br',
		            'username'=>'nti_timoteo',
		            'password'=>'c0mun1$ta2012',
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
			'class' => 'UsuarioSistema',
			// Adicionado para a extensão rights
			//'class'=>'RWebUser',
		),
		
		// 'bootstrap'=>array(
		//         'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		// ),
		
		// adicionado para a extensão rights
		'authManager'=>array(
			'class'=>'RDbAuthManager',  // Provides support authorization item sorting.
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
		     //'caseSensitive'=>false, 
      
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=ntiaplicacoes',
			'emulatePrepare' => true,
			'enableProfiling'=>true,
			'enableParamLogging'=>true,
			'username' => 'root',
			'password' => 'n2t0i11',
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
		'defaultPageSize'=>20,
	),

	
);
