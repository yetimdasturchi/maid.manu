<?php

namespace Model;

class View {
	
	public function render( $layout, $data, $title='', $description='', $keywords='') {
		$defaults = config_item('defaults');
		
		if ( empty( $title ) ) $title = $defaults['title'];
		if ( empty( $description ) ) $description = $defaults['description'];
		if ( empty( $keywords ) ) $keywords = $defaults['keywords'];

		load_view('head', [
			'title' => $title,
			'description' => $description,
			'keywords' => $keywords,
			'inc_js' => ( isset( $data['inc_js'] ) ) ? TRUE : FALSE,
		]);
		if ( isset( $data['inc_js'] ) ) unset($data['inc_js']); 
		load_view('layout/'.$layout, $data);
		load_view('foot');
	}

}