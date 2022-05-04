<main>
   <div class="w">
      <?php if($backButton): ?>
         <a href="<?php echo $backButton; ?>" title="orqaga">..</a>
      <?php endif; ?>
      <h1><?php echo $headline;?></h1>
      <?php echo $items; ?>
      <?php if( isset( $paging ) ) echo $paging; ?>
      </table>
   </div>
</main>