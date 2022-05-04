<?php

namespace Model;
use Embed\Embed;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;

use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;

use League\CommonMark\Extension\Table\TableExtension;

use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;

use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;

use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;

use League\CommonMark\Extension\ExternalLink\ExternalLinkExtension;

use League\CommonMark\Extension\Embed\EmbedExtension;
use League\CommonMark\Extension\Embed\Bridge\OscaroteroEmbedAdapter;

use League\CommonMark\MarkdownConverter;

class Md {
	
	private $config = [];

	private $auto_embed;
	private $auto_toc;
	private $remove_toc = FALSE;

	private $embed_width;
	private $embed_height;
	private $embed_allowed_domains;

	function __construct() {
		require_once FCPATH.'third_party/autoload.php';

		foreach ( config_item('md') as $k => $v) {
			$this->$k = $v;
		}
	}
	
	public function get( $md ){
		$this->config['html_input'] = 'escape';
		
		$this->config['table'] = [
			'wrap' => [
                'enabled' => false,
                'tag' => 'div',
            	'attributes' => [],
        	]
        ];

        $this->config['smartpunct'] = [
			'double_quote_opener' => '“',
            'double_quote_closer' => '”',
            'single_quote_opener' => '‘',
            'single_quote_closer' => '’',
        ];

        $this->config['footnote'] = [
			'backref_class'      => 'footnote-backref',
            'backref_symbol'     => '↵',
            'container_add_hr'   => false,
            'container_class'    => 'footnotes',
            'ref_class'          => 'footnote-ref',
            'ref_id_prefix'      => 'fnref:',
            'footnote_class'     => 'footnote',
            'footnote_id_prefix' => 'fn:',
        ];

        if ( $this->auto_toc ) {
        	
        	$this->config['heading_permalink'] = [
				'html_class' => 'heading-permalink',
	        	'insert' => 'after',
	        	'symbol' => '»',
	        	'title' => "Mundarija",
        	];

        	$this->config['table_of_contents'] = [
				'html_class' => 'table-of-contents',
	        	'position' => 'top',
	        	'style' => 'bullet',
	        	'min_heading_level' => 1,
	        	'max_heading_level' => 3,
	        	'normalize' => 'relative', //flat
	        	'placeholder' => null,
        	];
        }

        $this->config['external_link'] = [
			'internal_hosts' => strtolower($_SERVER['SERVER_NAME']),
	        'open_in_new_window' => true,
	        'html_class' => 'external-link',
	        'nofollow' => '',
	        'noopener' => 'external',
	        'noreferrer' => 'external',
        ];

		if ( $this->auto_embed ) {
			$embedLibrary = new Embed();
			$embedLibrary->setSettings([
		    	'oembed:query_parameters' => [
		        	'maxwidth' => $this->embed_width,
		        	'maxheight' => $this->embed_height,
		    	]
			]);

			$this->config['embed'] = [
		        'adapter' => new OscaroteroEmbedAdapter($embedLibrary),
		        'allowed_domains' => $this->embed_allowed_domains,
		        'fallback' => 'link',
		    ];
		}

		$environment = new Environment( $this->config );
		
		$environment->addExtension(new CommonMarkCoreExtension());

		$environment->addExtension(new FrontMatterExtension());
        $environment->addExtension(new TableExtension());
        $environment->addExtension(new StrikethroughExtension());
        $environment->addExtension(new SmartPunctExtension());
        $environment->addExtension(new FootnoteExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new AttributesExtension());
        $environment->addExtension(new TaskListExtension());
        if ( $this->auto_toc ) {
        	$environment->addExtension(new HeadingPermalinkExtension());
			$environment->addExtension(new TableOfContentsExtension());
		}
        $environment->addExtension(new ExternalLinkExtension());

		if ( $this->auto_embed ) $environment->addExtension(new EmbedExtension());

		$converter = new MarkdownConverter($environment);
		
		$result = $converter->convertToHtml($md);
		if ($result instanceof RenderedContentWithFrontMatter) {
    		$frontMatter = $result->getFrontMatter();
    		$res['yaml'] = $frontMatter;
    		if (array_key_exists('toc', $res['yaml'])) {
    			$this->remove_toc = ( $res['yaml']['toc'] ) ? FALSE : TRUE;
    		}
		}
		$res['html'] = $this->subparse( $result->getContent() );

		return $res;
	}

	private function remove_table_of_contents($html) {
		$html = preg_replace('#<ul\b[^>]+\bclass\s*=\s*[\'\"]table-of-contents[\'\"][^>]*>([\s\S]*?)</ul>#', ' ', $html);
		$html = preg_replace('#<a\b[^>]+\bclass\s*=\s*[\'\"]heading-permalink[\'\"][^>]*>([\s\S]*?)</a>#', ' ', $html);
		return $html;
	}

	private function subparse($html='') {
		$emojiparser = new Emojis([
			'image_url' => base_url('res/smileys'),
			'width' => 20,
			'height' => 20
		]);
		if ($this->remove_toc) {
			$html = $this->remove_table_of_contents($html);
		}
		$html = preg_replace('/\^(.*)\^/', "<sup>$1</sup>", $html);
		$html = preg_replace('/\~(.*)\~/', "<sub>$1</sub>", $html);
		$html = preg_replace('/\+\+(.*)\+\+/', "<ins>$1</ins>", $html);
		$html = preg_replace('/\=\=(.*)\=\=/', "<mark>$1</mark>", $html);
		$html = $emojiparser->set( $html )->toImg()->parse();
		return $html;
	}

}