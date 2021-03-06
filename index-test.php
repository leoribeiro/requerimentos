<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii-1.1.13/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/test.php';

defined('YII_DEBUG') or define('YII_DEBUG',true);
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);

$projetoMarcacao = 'marcacaoprovas';
$projetoRH = 'recursoshumanos';

Yii::setPathOfAlias('MarcacaoProva','../'.$projetoMarcacao.'/protected');
Yii::setPathOfAlias('RecursosHumanos','../'.$projetoRH.'/protected');


Yii::createWebApplication($config)->run();
