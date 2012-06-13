<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$yii=dirname(__FILE__).'/../../yii-1.1.10/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

require_once($yii);

defined('YII_DEBUG') or define('YII_DEBUG',true);

$projetoMarcacao = 'marcacaoprovas';
$projetoRH = 'recursoshumanos';

Yii::setPathOfAlias('MarcacaoProva','../'.$projetoMarcacao.'/protected');
Yii::setPathOfAlias('RecursosHumanos','../'.$projetoRH.'/protected');


Yii::createWebApplication($config)->run();
