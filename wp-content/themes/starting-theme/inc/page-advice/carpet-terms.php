<?php

  $intro = get_field('advice_intro');

 ?>

<div class="container-fluid">
  <div class="row">
    <?php
      include(locate_template("inc/page-advice/faq.php"));
      include(locate_template("inc/page-advice/terms.php"));
    ?>
  </div>
</div>
