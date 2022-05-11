<?php

namespace Model;
class Api {
	
	public function scan_index($rootDir, $allData=[]) {
	    $invisibleFileNames = [".", "..", ".htaccess", ".htpasswd", "errors", "index.html"];
	    $dirContent = array_diff(scandir($rootDir), ['..', '.']);
	    foreach($dirContent as $key => $content) {
	        $path = $rootDir.$content;
	        if ($content == 'index.yml') {
	        	$allData[$path] = filemtime($path);
	        }elseif(is_dir($path) && is_readable($path)) {
	        	$allData = self::scan_index($path.'/', $allData);
        	}
	    }
	    
	    arsort($allData);
	    return $allData;
	}

	public function build_sarray($arr=[], $path='', $data=[])
	{
		foreach ( $arr as $item ) {
			if ( !empty( $item['url'] ) ) {
				if ( !filter_var($item['url'], FILTER_VALIDATE_URL) ) {
					if ( mb_substr($item['url'], 0, 1) == '/' ) {
						$loc = base_url( ltrim($item['url'], '/') );
					}else{
						$loc = base_url( rtrim($path, '/') . '/' . $item['url'] ) ;
					}
				}
				$loc = str_replace(config_item('docs_path'), '/', $loc);
				$data[] = [
					'title' => $item['title'],
					'url' => $loc,
				];
			}
		}
		return $data;
	}

	public function get_entries($limit=FALSE, $offset=0, $sort=FALSE) {
		$yml = self::scan_index( config_item('docs_path'));
		$arr = [];
		foreach ($yml as $k => $v) {
			$y = load_yaml($k);
			$path = dirname( $k );
			if ( is_array( $y ) && !empty($y['entries'])) {
				$arr = array_merge($arr, self::build_sarray( $y['entries'], $path ));
			}
		}

		if ($sort == 'asc' || $sort == 'desc') {
			$arr = sortMultiArray($arr, ['title' => $sort]);
		}else if($sort == 'rand'){
			shuffle($arr);
		}
		return $limit ? array_slice($arr, $offset, $limit) : $arr;
	}

	public function search($q, $limit=FALSE, $offset=0)
	{
		$arr = search($q);
		return $limit ? array_slice($arr, $offset, $limit) : $arr;
	}

}