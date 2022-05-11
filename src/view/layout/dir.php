<main>
   <div class="w">
      <?php if($backButton): ?>
         <a href="<?php echo $backButton; ?>" title="orqaga">..</a>
      <?php endif; ?>
      <h1><?php echo $headline;?></h1>
      <?php if(!$backButton): ?>
         <p style="font-size: initial;"><em><?php echo nl2br(config_item('headquote'));?></em></p>
      <?php endif; ?>
      <?php echo $items; ?>
      <?php if( isset( $paging ) ) echo $paging; ?>
      </table>
   </div>
</main>