<?php

function load_yaml( $file ) {
	$yaml = file_get_contents( $file );
	return yaml_parse( $yaml );
}

function build_menu($yaml='', $str=FALSE)
{
	if ($str) $yaml = file_get_contents($yaml);
	if ( empty( $yaml ) ) return FALSE;
	
	if (is_array($yaml)) {
		$parsed = $yaml;
	}else{
		$parsed = yaml_parse($yaml);
		$parsed = $parsed['entries'];
	}
	
	if ( is_array( $parsed ) ) {
		
		if ( !empty( $parsed ) ) {
			$html = "<ul>";
			foreach ( $parsed as $item ) {
				if ( !empty( $item['post_list'] )) {

					$post_list = post_list( $item ); 
                    if ($post_list) $html .= preg_replace("/<ul>(.*)<\/ul>/", "$1", $post_list);
                    continue;
                }
				$html .= "<li>";
                $before = ( !empty( $item['before'] ) ) ? $item['before'].' ' : '';
                $after = ( !empty( $item['after'] ) ) ? ' '.$item['after'] : '';
				if ( !empty( $item['url'] ) ) {
					if ( !filter_var($item['url'], FILTER_VALIDATE_URL) ) {
						if ( mb_substr($item['url'], 0, 1) == '/' ) {
							$item['url'] = base_url( $item['url'] );
						}else{
							$item['url'] = rtrim(current_url(), '/') . '/' . $item['url'];
						}
					}
					
                    $taget = (!empty( $item['target'] )) ? " target=\"{$item['target']}\"" : "";
					$html .= "{$before}<a href=\"{$item['url']}\" title=\"".htmlspecialchars($item['title'])."\" {$taget}>{$item['title']}</a>{$after}";
				}else{
					$html .= "{$before}{$item['title']}{$after}";
				}
				if ( !empty( $item['entries'] ) ) {
					$html .= build_menu($item['entries']);
				}
				$html .= "</li>";
			
			}

			$html .= "</ul>";
			return $html;
		}

	}

	return FALSE;
}

function post_list($arr=[])
{	
	$post_list_path = config_item('docs_path').$arr['post_list'].'/'.'index.yml';
    if ( file_exists($post_list_path) ) {
        $post_list_data = yaml_parse( file_get_contents($post_list_path) );
        if (!empty( $post_list_data['entries'] ) && count($post_list_data['entries']) > 0) {
        	if ( !empty( $arr['order'] ) ) {
                if ($arr['order'] == 'random') {
                    shuffle($post_list_data['entries']);
                }else if ($arr['order'] == 'desc'){
                    $post_list_data['entries'] = array_reverse($post_list_data['entries']);
                }
            }
            $data = ($arr['limit']) ? array_slice($post_list_data['entries'], 0, $arr['limit']) : $post_list_data['entries'];
            $data = rebuild_post_list_url($data, $arr['post_list']);
            if ( !empty( $arr['show_more'] ) && $arr['show_more'] == true) {
                $text = ( !empty( $arr['show_more_text'] ) && $arr['show_more_text'] != '') ? $arr['show_more_text'] : 'barchasi...';
                $url = ( !empty( $arr['show_more_url'] ) && $arr['show_more_url'] != '') ? $arr['show_more_url'] : '/';
                $data[] = [
                    'title' => $text,
                    'url' => $url,
                ];
            }
            return build_menu( $data );;
        }
    }

    return FALSE;
}

function rebuild_post_list_url($data=[], $path='')
{
    
    foreach ($data as $k => $v) {
        if(!filter_var($v['url'], FILTER_VALIDATE_URL)){
            
            if ( !empty( $data[$k]['url'] ) ) $data[$k]['url'] = $path.'/'.$v['url'];
            if ( !empty( $data[$k]['entries'] ) ) $data[$k]['entries'] = rebuild_post_list_url( $data[$k]['entries'], $path);
        }
    }

    return $data;
}

function replace_extension($filename, $new_extension) {
    $info = pathinfo($filename);
    return $info['filename'] . '.' . $new_extension;
}