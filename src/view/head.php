<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo $title;?></title>
  <meta property="og:title" content="<?php echo $title;?>" />
  <meta name="author" content="Manuchehr Usmonov" />
  <meta property="og:locale" content="uz_UZ" />
  <meta name="description" content="<?php echo $description;?>" />
  <meta name="keywords" content="<?php echo $keywords;?>" />
  <meta property="og:description" content="<?php echo $description;?>" />
  <meta property="og:url" content="<?php echo current_url();?>" />
  <meta property="og:site_name" content="<?php echo str_replace('www.', '', parse_url(current_url(), PHP_URL_HOST));?>" />
  <meta name="og:type" content="article">
  <script type="application/ld+json">
    <?php 
      echo json_encode([
        'description' => $description,
        'url' => current_url(),
        '@type' => "WebSite",
        'headline' => $title,
        'author' => [
          '@type' => 'Person',
          'name' => 'Manuchehr Usmonov'
        ],
        '@context' => 'https://schema.org'


      ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    ?>
  </script>
  <link type="application/atom+xml" rel="alternate" href="<?php echo base_url('feed.xml');?>" title="<?php echo htmlentities($title) ?>" />
  
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('res/apple-touch-icon.png');?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('res/favicon-32x32.png');?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('res/favicon-16x16.png');?>">
  <link rel="manifest" href="<?php echo base_url('res/site.webmanifest');?>">
  <link rel="mask-icon" href="<?php echo base_url('res/safari-pinned-tab.svg');?>" color="#ff9933">
  <link rel="shortcut icon" href="<?php echo base_url('res/favicon.ico');?>">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="msapplication-config" content="<?php echo base_url('res/browserconfig.xml');?>">
  <meta name="theme-color" content="#000000">
  <meta name="msapplication-navbutton-color" content="#000000">
  <meta name="apple-mobile-web-app-status-bar-style" content="#000000">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url( 'res/min.css?v='.APP_VERSION );?>">
</head>
 <body>