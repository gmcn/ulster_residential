<?php
global $wp;
?>
<div class="l-filter_pagination">
  <div class="row">
    <div class="col-md-2 sub-title_content">
      <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Filter: <strong><?php initialFilterLabel($ranges_type); ?></strong> <img src="<?php echo get_template_directory_uri() ?>/images/filter_dropicon.svg" alt="Filter: Range ">
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <li class="cat-item"><a href="<?php echo site_url(); ?>/choose-a-carpet/<?php echo taxToPath($ranges_type); ?>">See All</a></li>
          <?php wp_list_categories(array('title_li' => '', 'taxonomy' => $ranges_type)); ?>
        </ul>
      </div>
    </div>
    <?php
    if ($ranges_type != 'ranges_colour') : //don't show colour filter if already in ranges
      $tax_slug = get_query_var('term');

      $color_post_ids = get_posts(array(
        'post_type' => 'ranges',
        'posts_per_page' => -1,
        'tax_query' => array(
          array(
            'taxonomy' => $ranges_type,
            'field' => 'slug',
            'terms' => $tax_slug
          )
        ),
        'fields' => 'ids'
      ));
      $colours = wp_get_object_terms($color_post_ids, 'ranges_colour');

      ?>

      <div class="col-md-2 sub-title_content">
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Filter: <strong> <?php
                                if (array_key_exists('colour', $_GET)) {
                                  echo ucfirst($_GET['colour']);
                                } else {
                                  echo 'Colour';
                                } ?></strong> <img src="<?php echo get_template_directory_uri() ?>/images/filter_dropicon.svg" alt="Filter: Colour ">
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="<?php
                            removeUrlParams('colour', home_url($wp->request)); ?>">All Colours</a></li>
            <?php foreach ($colours as $item) : ?>
              <li><a href="<?php getUrlParams(taxToKey($item->taxonomy), $item->slug, home_url($wp->request)); ?>"><?php echo $item->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    <?php endif; //end if we aren't already in colour ranges
    ?>


  </div>
  <div class="col-md-6 e-pagination">
    <?php

    ?>
  </div>
</div>
</div>
