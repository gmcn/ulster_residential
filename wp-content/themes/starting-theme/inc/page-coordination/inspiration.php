<?php
$pagelist = get_pages('sort_column=menu_order&sort_order=asc');
$pages = array();
foreach ($pagelist as $page) {
$pages[] += $page->ID;
}

$current = array_search(get_the_ID(), $pages);
$prevID = $pages[$current-1];
$nextID = $pages[$current+1];

global $wp;

$thumbnail = get_the_post_thumbnail_url();

?>
<div class="container-fluid inspiration">
  <div class="row">
    <div class="col-md-8 inspiration_img">
      <img src="<?php echo $thumbnail ?>" alt="<?php echo the_title(); ?>">


      <?php

        $post_objects = get_field('ranges_included');

        if( $post_objects ): ?>
          <div class="inspiration_ranges">
            <h3>Ranges Included:</h3>
            <?php foreach( $post_objects as $post):

              $thumbnail = get_the_post_thumbnail_url();
              $excerpt = get_the_excerpt();

              $term_obj_list = get_the_terms( $post->ID, 'ranges_type' );
              $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));

              $terms_desc = join(', ', wp_list_pluck($term_obj_list, 'description'));

              ?>
                <?php setup_postdata($post); ?>
                <div class="col-md-3 col-sm-6 inspiration_ranges_range wow fadeInLeft">
                  <div class="wrapper" style="background: url(<?php echo $terms_desc ?>) center center; height:288px; background-size: cover;">
                    <a href="<?php echo site_url(); ?>/ranges_type/<?php echo $terms_string; ?>">
                      <div class="hover">

                        <div class="vert-align">
                          <?php echo $terms_string; ?>
                        </div>


                        <div class="hover_view">
                         View Product Range
                        </div>

                      </div>
                    </a>
                  </div>

                </div>
            <?php endforeach; ?>
          </div>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php endif; ?>


    </div>
    <div class="col-md-4">
      <?php if( have_rows('feature_index') ): ?>

      	<?php $i = 1; while( have_rows('feature_index') ): the_row();

      		// vars
      		$featureIndexCopy = get_sub_field('feature_index_copy');

      		?>

      		<div class="row inspiration_features">

            <div class="col-xs-2 col-md-3 col-lg-2">
              <div class="inspiration_features_count">
                <div class="vert-align">
                  #<?php echo $i; ?>
                </div>
              </div>
            </div>

            <div class="col-xs-10 col-md-9 col-lg-10">
              <p><?php echo $featureIndexCopy; ?></p>
            </div>

      		</div>

      	<?php $i++; endwhile; ?>

      <?php endif; ?>
    </div>
  </div>

  <div class="row inspiration_action">
    <div class="col-md-4 share">

      <div class="dropdown">
      <a href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        +Share
      </a>
      <ul class="dropdown-menu" aria-labelledby="dLabel">
        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo home_url($wp->request) ?>" onclick="return !window.open(this.href, '', 'width=550,height=400')" class="fb-xfbml-parse-ignore"><img src="<?php echo get_template_directory_uri() ?>/images/facebook_icon.svg" alt="Facebook"></a></li>

        <li><a class="twitter-share-button" href="https://twitter.com/intent/tweet?tweet?original_referer=<?php echo home_url($wp->request) ?>&text=<?php echo the_title(); ?> <?php echo home_url($wp->request) ?>" onclick="return !window.open(this.href, '', 'width=550,height=400')" target="_blank"><img src="<?php echo get_template_directory_uri() ?>/images/twitter_icon.svg" alt="Twitter"></a></li>

        <li>
          <a data-pin-do="buttonPin" href="https://www.pinterest.com/pin/create/button/?url=<?php echo home_url($wp->request) ?>&media=<?php echo $thumbnail ?>!" onclick="return !window.open(this.href, '', 'width=550,height=400')" data-pin-custom="true"><img src="<?php echo get_template_directory_uri() ?>/images/pinterest_icon.svg" alt="Pinterest"></a>
        </li>

      </ul>
    </div>

    </div>
    <div class="col-md-4 back">
      <a href="<?php echo site_url(); ?>/choose-a-carpet/colour-coordination/">Back to colour coordination</a>
    </div>
    <div class="col-md-4 next">

      <?php
      if (!empty($nextID)) : ?>
      <div class="alignright">
      <a href="<?php echo get_permalink($nextID); ?>"
       title="<?php echo get_the_title($nextID); ?>">Next Moodboard <img src="<?php echo get_template_directory_uri() ?>/images/next.svg" alt=""> </a>
       </div>
     <?php endif; ?>

    </div>
  </div>


</div>
