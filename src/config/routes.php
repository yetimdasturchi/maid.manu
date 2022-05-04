<?php

//$router['/dictionary[/]?'] = array('Dictionary', 'index');

$router['([a-zA-Z0-9_\.-/]+\.(html|htm))'] = array('File', 'index');
$router['(.*/){0,0}[^\.]*'] = array('Directory', 'index');