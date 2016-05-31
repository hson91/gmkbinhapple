<?php
if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('UTC');
}
// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

$yii=dirname(__FILE__).'/lib/yii/yiilite.php';
require_once($yii);
// change the following paths if necessary
$config=dirname(__FILE__).'/protected/config/main.php';
Yii::createWebApplication($config)->run();
