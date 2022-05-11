<?php

namespace Model;
use DateTime;
class Sitemap {
	
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
				$filename = $path.'/'.str_replace(['.html', '.htm'], '.md', $item['url']);
				$lastmod = file_exists($filename) ? filectime( $filename ) : 0;
				$data[] = [
					'loc' => $loc,
					'lastmod' => date('Y-m-d', ($lastmod) ? $lastmod : time() ),
					'sort_index' => $lastmod,
					'changefreq' => 'daily',
					'priority' => '0.5',
				];
			}
		}
		return $data;
	}

	public function get_entries($limit=FALSE) {
		$yml = self::scan_index( config_item('docs_path'));
		$arr = [];
		foreach ($yml as $k => $v) {
			$y = load_yaml($k);
			$path = dirname( $k );
			if ( is_array( $y ) && !empty($y['entries'])) {
				$arr = array_merge($arr, self::build_sarray( $y['entries'], $path ));
			}
		}
		usort($arr, function($a, $b) {
  			return ($a['sort_index'] < $b['sort_index']) ? -1 : 1;
		});
		$arr = array_reverse($arr);
		return $limit ? array_slice($arr, 0, $limit) : $arr;
	}

}