<?php

// change the following paths if necessary
$yii=dirname(__FILE__).'/../yii-1.1.13/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// Quando YII_DEBUG está false ele está em modo produção
defined('YII_DEBUG') or define('YII_DEBUG',false);

require_once($yii);

$projetoMarcacao = 'marcacaoprovas';
$projetoRH = 'recursoshumanos';

Yii::setPathOfAlias('MarcacaoProva','../'.$projetoMarcacao.'/protected');
Yii::setPathOfAlias('RecursosHumanos','../'.$projetoRH.'/protected');

Yii::createWebApplication($config)->run();
