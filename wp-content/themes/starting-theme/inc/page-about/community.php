<?php

  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');

 ?>

<div class="container-fluid community">
  <div class="row">
    <div class="col-md-6 matchheight">
      <img src="<?php echo $featured_img_url; ?>" alt="<?php echo the_title(); ?>">
    </div>
    <div class="col-md-6 community_content matchheight">
      <?php echo the_content(); ?>
    </div>
  </div>



    <?php if( have_rows('community') ): ?>

    	<?php $i = 1; while( have_rows('community') ): the_row();

    		// vars
    		$image = get_sub_field('image');
    		$content = get_sub_field('content');
    		$title = get_sub_field('title');
        $btn_action = get_sub_field('btn_action');

    		?>

        <div class="row community_children">

          <div class="col-md-6">
            <div class="community_children_count">
              <p>#0<?php echo $i; ?></p> 
            </div>
            <img src="<?php echo $image ?>" alt="<?php echo $title ?>">
          </div>

          <div class="col-md-6 community_children_content">
            <h2><?php echo $title ?></h2>
            <?php echo $content; ?>
            <?php if ($btn_action): ?>
              <a class="more" href="<?php echo $btn_action ?>" target="_blank">Find out more</a>
            <?php endif; ?>
          </div>

        </div>

        <hr />

    	<?php $i++; endwhile; ?>

    <?php endif; ?>




</div>
