<?php

namespace Controller;
use Model;

class File {
	
	public function index( $filename ) {
		$path = config_item('docs_path') . ltrim(str_replace(['.html', '.htm'], '.md', $filename), '/');
		if (! file_exists($path)) {
			show_404();
			exit;
		}
		$md = file_get_contents( $path );
		$parser = new Model\Md();
		$res = (array)$parser->get( $md );
		if ($filename != '/donate.htm') {
			$res['html'] = "<p><blockquote>Loyihani qo'llab quvvatlash uchun <a href=\"/donate.htm\">buyerga</a> bosing</blockquote></p>".$res['html'];
		}
		$data['html'] = $res['html'];
		$daya['inc_js'] = $inc_js;
		$data['headline'] = $res['yaml']['title'];
		$data['backButton'] =  dirname( $filename );
		Model\View::render( 'file', $data, $res['yaml']['title'], $res['yaml']['description'], $res['yaml']['keywords']);
	}
}