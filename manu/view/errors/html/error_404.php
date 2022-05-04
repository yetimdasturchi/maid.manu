<?php
	$defaults = config_item( 'defaults');
	$defaults['title'] = $heading;
	$defaults['description'] = strip_tags($message);
	extract( $defaults );
	include VIEWPATH.'head.php';
?>
<main class="page-content" aria-label="Content">
      <div class="w">
        <a href="/">..</a>
        <h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>

      </div>
</main>
<?php
	include VIEWPATH.'head.php';
?>