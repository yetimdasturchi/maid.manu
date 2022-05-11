<?php

namespace Controller;
use Model;

class Api
{
	function __construct() {
		header('Content-Type: application/json; charset=utf-8');
	}
	
	public function index()
	{
		header("Location: /api.htm");
	}

	public function method($uri, $sw)
	{
		if ( method_exists( $this, $sw ) ) {
			$this->$sw();
		}else{
			echo json_encode([
				'status' => "error",
				'message' => "Noto'g'ri so'rov"
			]);
			exit(4);
		}
	}

	public function urls()
	{
		$limit = ( !empty($_GET['limit']) && intval( $_GET['limit'] ) > 0 ) ? intval( $_GET['limit'] ) : FALSE;
		$offset = ( !empty($_GET['offset']) && intval( $_GET['offset'] ) > 0 ) ? intval( $_GET['offset'] ) : 0;
		$sort = ( !empty($_GET['sort']) && in_array($_GET['sort'], ['asc', 'desc', 'rand']) ) ? $_GET['sort'] : FALSE;
		$entries = Model\Api::get_entries( $limit, $offset, $sort );
		echo json_encode([
			'status' => "ok",
			'data' => $entries
		]);
		exit(4);
	}

	public function search()
	{
		if ( empty( $_GET['q'] ) || strlen($_GET['q']) < 2 ) {
			echo json_encode([
				'status' => "error",
				'message' => ( !empty( $_GET['q'] ) ) ? "Qidiruv uchun kalit so'z kamida ikkita belgidan iborat bo'lishi kerak" : "Qidiruv uchun kalit so'z kiritilmagan"
			]);
			exit(4);
		}
		$limit = ( !empty($_GET['limit']) && intval( $_GET['limit'] ) > 0 ) ? intval( $_GET['limit'] ) : FALSE;
		$offset = ( !empty($_GET['offset']) && intval( $_GET['offset'] ) > 0 ) ? intval( $_GET['offset'] ) : 0;
		$entries = Model\Api::search( $_GET['q'], $limit, $offset );
		echo json_encode([
			'status' => "ok",
			'data' => $entries
		]);
		exit(4);
	}
} 