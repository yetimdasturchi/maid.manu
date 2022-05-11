<?php
function scanDirectories($rootDir, $allData=array()) {
    $invisibleFileNames = [".", "..", ".htaccess", ".htpasswd", "errors", "index.html"];
    $dirContent = array_diff(scandir($rootDir), ['..', '.']);
    foreach($dirContent as $key => $content) {
        $path = $rootDir.'/'.$content;
        if(is_file($path) && is_readable($path)) {
            if( preg_match('/^.*\.(md)$/i', $path) ) $allData[] = $path;
		}elseif(is_dir($path) && is_readable($path)) {
        	$allData = scanDirectories($path, $allData);
        }
    }
    return $allData;
}

function remove_yaml($str){
	$quote = static function ($str) {
    	return preg_quote($str, "~");
	};

	$regex = '~^('
    	.implode('|', array_map($quote, ['---']))
        ."){1}[\r\n|\n]*(.*?)[\r\n|\n]+("                     
        .implode('|', array_map($quote, ['---']))   
        ."){1}[\r\n|\n]*(.*)$~s";          
    if (preg_match($regex, $str, $matches) === 1) { // There is a Front matter
		$yaml = trim($matches[2]) !== '' ? yaml_parse( trim($matches[2]) ) : null;
		$str = ltrim($matches[4]);
	}

	return [$str, $yaml];
}

function extract_words($text)
{
  $text = trim( preg_replace( ['/\s{2,}/', '/[\t\n]/'], ' ', $text ) );
  return preg_split("/[^\w]*([\s]+[^\w]*|$)/", $text, -1, PREG_SPLIT_NO_EMPTY);;
}

function search_dis($query, $text, $minlev=2)
{
    $words = extract_words($text);
    $diss = 0;
    foreach($words as $word){
      $lev = levenshtein($query, $word);  
      if($lev <= $minlev) $diss++;
    }
    return $diss;
}

function find_similar($search='', $lines){
  	if ($search == '') return FALSE;
  	$temp = [];
  	foreach($lines as $line) {
    	if(stripos($line, $search) !== false) {
      		$temp[] = [
        		'dis' => 0,
        		'text' => $line,
      		];
    	}else{
	    	$diss = search_dis( $search, $line);
	      	if($diss > 0){
	        	$temp[] = [
	          		'dis' => $diss,
	          		'text' => $line,
	        	];
	      	}
	    }
	}

	usort($temp, function($a, $b){
    	if($a['dis']==$b['dis']) return 0;
    	return $a['dis'] > $b['dis']?1:-1;
	});
	
	return $temp;
}

function sort_index($arr=[], $key){
	usort($arr, function($a, $b) use ($key) {
    	if($a[$key]==$b[$key]) return 0;
    	return $a[$key] < $b[$key]?1:-1;
	});

	return $arr;
}

function search($string=FALSE)
{
	if(!$string) return;
	$docs_dir = config_item('docs_path');
	$dirs = scanDirectories($docs_dir);
	$idx_0 = [];
	$idx_1 = [];
	foreach ($dirs as $file) {
    	$md = file_get_contents($file);
    	$md = remove_yaml($md);
    	$yaml = $md[1]; 
    	if (empty($yaml['title'])) continue;
    	$md = preg_replace("/[\*|\`|\[|\]|\#]/im", "", $md[0]);
    	$diss = find_similar( $string, explode(PHP_EOL, $md));
    	$count = array_count_values(array_column($diss, 'dis'));
    	$file = '/'.ltrim(str_replace([$docs_dir, '.md'], ['', '.htm'], $file), '/');
    	if ( isset($count[0]) ) {
        	$idx_0[] = [
        		'url' => $file,
        		'c' => $count[0],
        		'title' => $yaml['title'],
        		'after' => '(O\'xshashliklar: '.$count[0].')'
        	];
    	}else if( isset($count[1]) ){
    		$idx_1[] = [
        		'url' => $file,
        		'c' => $count[1],
        		'title' => $yaml['title'],
        		'after' => '(O\'xshashliklar: '.$count[1].')'
        	];
    	}
	}

	if ( count($idx_0) > 0 ) {
		$idx_0 = sort_index($idx_0, 'c');
		return $idx_0;
	}else if ( count($idx_1) > 0 ) {
		$idx_1 = sort_index($idx_1, 'c');
		return $idx_1;
		exit;
	}

	return FALSE;
}