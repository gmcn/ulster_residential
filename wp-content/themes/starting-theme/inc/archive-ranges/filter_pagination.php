<div class="l-filter_pagination">
  <div class="row">
    <div class="col-md-2 sub-title_content">

      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Filter: <strong><?php initialFilterLabel($ranges_type); ?></strong> <img src="<?php echo get_template_directory_uri() ?>/images/filter_dropicon.svg" alt="Filter: Range ">
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <?php wp_list_categories(array('title_li' => '', 'taxonomy' => $ranges_type)); ?>
        </ul>
      </div>
    </div>

    <?php
    $taxcats = array('ranges_type' => 'Range', 'ranges_style' => 'Style', 'ranges_colour' => 'Colour');
    unset($taxcats[$ranges_type]);

    foreach ($taxcats as $tax_name => $tax_label) :
      ?>
      <div class="col-md-2 sub-title_content">
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Filter: <strong><?php initialFilterLabel($tax_name); ?></strong> <img src="<?php echo get_template_directory_uri() ?>/images/filter_dropicon.svg" alt="Filter: <?php initialFilterLabel($tax_name); ?> ">
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php wp_list_categories(array('title_li' => '', 'taxonomy' => $tax_name)); ?>
          </ul>
        </div>
      </div>

    <?php endforeach; ?>

    <div class="col-md-6 e-pagination">
      <?php

      ?>
    </div>
  </div>
</div>