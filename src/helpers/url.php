<?php

function base_url( $uri = '' ){
  return sprintf(
    "%s://%s/%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    ltrim(_uri_string($uri), '/')
  );
}

function _uri_string($uri) {
	return ( is_array($uri) && $uri = implode('/', $uri) ) ? ltrim($uri, '/') : $uri;
}

function current_url(){
	return base_url( explode('/', strtok($_SERVER['REQUEST_URI'], '?')) );
}