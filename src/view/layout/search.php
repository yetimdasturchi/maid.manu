<main>
   <div class="w">
      <?php if($backButton): ?>
         <a href="<?php echo $backButton; ?>" title="orqaga">..</a>
      <?php endif; ?>
      <h1><?php echo $headline;?></h1>
      <p>Kerakli ma'lumotlarni izlash uchun kalit so'zni kiritib <em>enter</em> tugmasini bosing</p>
      <form autocomplete="off" method="get" id="searchform">
         <input type="search" name="term" id="searchterm" placeholder="Kalit so'z..." value="<?php if( isset( $term ) ) echo $term; ?>">
      </form>
      
      <?php if( isset( $to_short ) ):?>
         <p><em>Kechirasiz izlash uchun kamida <?php echo $to_short;?>ta belgi kiritilishi lozim!</em></p>
      <?php endif; ?>
      <?php if( isset( $no_items ) ):?>
         <p><em>Kechirasiz sizning so'rovingizga binoan hech qanday ma'lumot topilmadi :(</em></p>
      <?php endif; ?>
      <?php if( isset( $items ) ):?>
         <p><em>Izlash natijalari:</em></p>
         <?php echo $items;?>
      <?php endif; ?>
      <?php if( isset( $paging ) ) echo $paging; ?>
   </div>
</main>