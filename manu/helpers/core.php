<?php

function _error_handler($severity, $message, $filepath, $line) {
	$is_error = (((E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR | E_USER_ERROR) & $severity) === $severity);

	if ( $is_error ) set_status_header(500);

	//if (($severity & error_reporting()) !== $severity) return;

	if (str_ireplace(array('off', 'none', 'no', 'false', 'null'), '', ini_get('display_errors'))) {
		show_php_error($severity, $message, $filepath, $line);
	}

	if ( $is_error ) {
		exit(1); 
	}
}

function show_php_error($severity, $message, $filepath, $line) {
	
	$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;

	$severity = levels_code( $severity, $severity );

	$filepath = str_replace('\\', '/', $filepath);
	if (FALSE !== strpos($filepath, '/')) {
		$x = explode('/', $filepath);
		$filepath = $x[count($x)-2].'/'.end($x);
	}

	$template = 'html'.DIRECTORY_SEPARATOR.'error_php';

	if (ob_get_level() > ob_get_level() + 1) ob_end_flush();
	
	ob_start();
	include($templates_path.$template.'.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	echo $buffer;
}

function set_status_header($code = 200, $text = '') {
	if (empty($code) OR ! is_numeric($code)) show_error('Holat kodi raqam shaklida boʻlishi lozim', 500);

	if (empty($text)) {
		is_int($code) OR $code = (int) $code;
		$stati = [
			100	=> 'Continue',
			101	=> 'Switching Protocols',

			200	=> 'OK',
			201	=> 'Created',
			202	=> 'Accepted',
			203	=> 'Non-Authoritative Information',
			204	=> 'No Content',
			205	=> 'Reset Content',
			206	=> 'Partial Content',

			300	=> 'Multiple Choices',
			301	=> 'Moved Permanently',
			302	=> 'Found',
			303	=> 'See Other',
			304	=> 'Not Modified',
			305	=> 'Use Proxy',
			307	=> 'Temporary Redirect',

			400	=> 'Bad Request',
			401	=> 'Unauthorized',
			402	=> 'Payment Required',
			403	=> 'Forbidden',
			404	=> 'Not Found',
			405	=> 'Method Not Allowed',
			406	=> 'Not Acceptable',
			407	=> 'Proxy Authentication Required',
			408	=> 'Request Timeout',
			409	=> 'Conflict',
			410	=> 'Gone',
			411	=> 'Length Required',
			412	=> 'Precondition Failed',
			413	=> 'Request Entity Too Large',
			414	=> 'Request-URI Too Long',
			415	=> 'Unsupported Media Type',
			416	=> 'Requested Range Not Satisfiable',
			417	=> 'Expectation Failed',
			422	=> 'Unprocessable Entity',
			426	=> 'Upgrade Required',
			428	=> 'Precondition Required',
			429	=> 'Too Many Requests',
			431	=> 'Request Header Fields Too Large',

			500	=> 'Serverdagi ichki xatolik',
			501	=> 'Amalga oshirilmagan',
			502	=> 'Shlyuzdan javob olishda xatolik',
			503	=> 'Servis ish faoliyatida emas',
			504	=> 'Shlyuz vaqti tugadi',
			505	=> 'HTTP versiyasi qoʻllab-quvvatlanmaydi',
			511	=> 'Tarmoq indenfikatsiyasi talab qilinadi',
		];

		if ( isset($stati[$code]) ) {
			$text = $stati[$code];
		} else {
			show_error('Ushbu holat uchun hech qanday matn mavjud emas. Iltimos, holat kodi raqaminni tekshiring yoki maqbul xabar matnini kiriting.', 500);
		}
	}

	if (strpos(PHP_SAPI, 'cgi') === 0) {
		header('Status: '.$code.' '.$text, TRUE);
		return;
	}

	$server_protocol = (isset($_SERVER['SERVER_PROTOCOL']) && in_array($_SERVER['SERVER_PROTOCOL'], array('HTTP/1.0', 'HTTP/1.1', 'HTTP/2', 'HTTP/2.0'), TRUE))
		? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
	header($server_protocol.' '.$code.' '.$text, TRUE, $code);
}


function show_error($message, $status_code = 500, $heading = 'An Error Was Encountered') {
	$status_code = abs($status_code);
	if ($status_code < 100) {
		$exit_status = $status_code + 9;
		$status_code = 500;
	} else {
		$exit_status = 1; 
	}
	echo show_error_template($heading, $message, 'error_general', $status_code);
	exit($exit_status);
}

function show_error_template($heading, $message, $template = 'error_general', $status_code = 500) {
	$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;

	set_status_header( $status_code );
	$message = '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>';
	$template = 'html'.DIRECTORY_SEPARATOR.$template;

	if (ob_get_level() > ob_get_level() + 1) {
		ob_end_flush();
	}
	ob_start();
	include($templates_path.$template.'.php');
	$buffer = ob_get_contents();
	ob_end_clean();
	return $buffer;
}

function levels_code( $level, $severity ) {
	$levels = [
		E_ERROR				=>	'Xatolik',
		E_WARNING			=>	'Ogohlantirish',
		E_PARSE				=>	'Tahliliy xatolik',
		E_NOTICE			=>	'Eslatma',
		E_CORE_ERROR		=>	'Core Error',
		E_CORE_WARNING		=>	'Core Warning',
		E_COMPILE_ERROR		=>	'Compile Error',
		E_COMPILE_WARNING	=>	'Compile Warning',
		E_USER_ERROR		=>	'User Error',
		E_USER_WARNING		=>	'User Warning',
		E_USER_NOTICE		=>	'User Notice',
		E_STRICT			=>	'Runtime Notice'
	];

	return ( isset( $levels[ $level ] ) ) ? $levels[ $level ] : $severity;
}

function route( $regex, $callback ) {
	$regex = '/^' . str_replace( '/', '\/', $regex ) . '$/';
	if ( preg_match( $regex, strtok($_SERVER['REQUEST_URI'], '?'), $params ) ) {
		//array_shift($params);
		call_user_func_array( $callback, array_values( $params ) );
		return TRUE;
	}

	return FALSE;
}

function show_404() {
	$heading = 'Sahifa mavjud emas';
	$message = 'Siz murojaat qilgan sahifa mavjud emas.';
	echo show_error_template($heading, $message, 'error_404', 404);
	exit(4);
}

function config_item($item) {
	if ( !empty( $GLOBALS['config'] ) ) {
		return isset($GLOBALS['config'][$item]) ? $GLOBALS['config'][$item] : NULL;
	}

	return FALSE;
}

function load_view( $path, $vars=[] ) {
	ob_start();
		extract( $vars );
		include(VIEWPATH. $path . '.php');
		$buffer = ob_get_contents();
	ob_end_clean();
	echo $buffer;
}