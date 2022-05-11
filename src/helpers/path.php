<?php

function sortMultiArray($arr=[], $sort=[])
{
	//if (empty($arr)) return $arr;

	usort($arr, function($a, $b) use ($sort) {
    	foreach($sort as $field => $direction) {
    		if ($a[$field] != $b[$field]) {
        		if ($direction == 'asc') {
					
            		return $a[$field] < $b[$field] ? -1 : 1;
        		}
        		return $a[$field] < $b[$field] ? 1 : -1;
    		}
		}
		return 0;
	});
	return $arr;
}