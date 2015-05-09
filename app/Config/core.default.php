<?php

Configure::write('debug', 0);

Configure::write('Email.SenderAddress','');
Configure::write('Email.SenderName','Truckr');
Configure::write('Email.UrlRoot','localhost');

Configure::write('Error', array(
    'handler' => 'ErrorHandler::handleError',
    'level' => E_ALL & ~E_DEPRECATED,
    'trace' => true
));


Configure::write('Exception', array(
    'handler' => 'ErrorHandler::handleException',
    'renderer' => 'ExceptionRenderer',
    'log' => true
));


Configure::write('App.encoding', 'UTF-8');

define('LOG_ERROR', 2);


Configure::write('Session', array(
    'defaults' => 'php'
));

Configure::write('Security.level', 'medium');
Configure::write('Security.salt', 'k7fnsdnknsdf9sdfnksjnsd8fsd');
Configure::write('Security.cipherSeed', '5555558385212105947245954345');

Configure::write('Acl.classname', 'DbAcl');
Configure::write('Acl.database', 'default');

Configure::write('Slack.Url', '');
Configure::write('Slack.DefaultChannel', '');

$engine = 'File';
if (extension_loaded('apc') && function_exists('apc_dec') && (php_sapi_name() !== 'cli' || ini_get('apc.enable_cli'))) {
	$engine = 'Apc';
}

$duration = '+999 days';
if (Configure::read('debug') >= 1) {
	$duration = '+10 seconds';
}

Cache::config('_cake_core_', array(
	'engine' => $engine,
	'prefix' => 'cake_core_',
	'path' => CACHE . 'persistent' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));

Cache::config('_cake_model_', array(
	'engine' => $engine,
	'prefix' => 'cake_model_',
	'path' => CACHE . 'models' . DS,
	'serialize' => ($engine === 'File'),
	'duration' => $duration
));
