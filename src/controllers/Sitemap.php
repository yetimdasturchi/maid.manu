<?php

namespace Controller;
use Model;

class Sitemap
{
	
	public function index()
	{
		header('Content-Type: text/xml');
		$limit = ( !empty($_GET['limit']) && intval( $_GET['limit'] ) > 0 ) ? intval( $_GET['limit'] ) : FALSE;
		$entries = Model\Sitemap::get_entries( $limit );

		echo '<?xml version=\'1.0\' encoding=\'UTF-8\'?>';
		echo "\n";
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
			xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
			xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
					    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
		echo "\n";
		foreach ($entries as $link) {
			echo "\t<url>\n";
			echo "\t\t<loc>" . htmlentities($link['loc']) . "</loc>\n";
			echo "\t\t<lastmod>{$link['lastmod']}</lastmod>\n";
			echo "\t\t<changefreq>{$link['changefreq']}</changefreq>\n";
			echo "\t\t<priority>{$link['priority']}</priority>\n";
			echo "\t</url>\n";
		}
		echo '</urlset>';
	}
}