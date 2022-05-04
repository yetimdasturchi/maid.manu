<?php

namespace Controller;
use Model;

class Directory {
	
	public function index( $dir ) {
		$path = config_item( 'docs_path' ) . ( ( $dir == '/' ) ? 'index.yml' : trim( $dir, "/" ) . '/index.yml' );

		if ( !file_exists( $path ) ) show_404();

		$yaml = load_yaml( $path );
		$data['headline'] = $yaml['title'];
		$data['items'] = $yaml['entries'];

		if ( !empty( $yaml['pagination'] ) && $yaml['pagination'] == TRUE ) {
			$paging = new Model\Paging([
				'data' => $yaml['entries'],
				'limit' => 20,
				'base_url' => current_url()
			]);

			$paging->setPage( (isset($_GET['page']) ? $_GET['page'] : 1) );
			
			$data['items'] = $paging->getData();
			$data['paging'] = (count($yaml['entries']) > 20) ? $paging->getLinks() : '';
		}

		$data['backButton'] =  ($dir != '/') ? dirname( $dir ) : FALSE;
		$data['items'] = build_menu( $data['items']);
		Model\View::render( 'dir', $data, $yaml['title'], $yaml['description'], $yaml['keywords']);
	}
}