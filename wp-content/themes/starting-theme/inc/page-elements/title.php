<?php

  $cat_obj = $wp_query->get_queried_object();
  $thiscat_id = $cat_obj->name;

 ?>

<div class="title">
  <div class="row">
    <div class="col-md-6">

      <?php if (is_post_type_archive('ulsterathome') || is_singular('ulsterathome')) : ?>

        <h1>#Ulsterathome Gallery</h1>

      <?php elseif (is_post_type_archive('gallery') || is_singular('gallery')) : ?>

        <h1>Gallery</h1>

      <?php elseif(is_tag()) : ?>

        <h1><?php printf( __( 'Tag: %s', 'pietergoosen' ), single_tag_title( '', false ) ); ?></h1>



      <?php elseif (is_tax( 'ranges_colour' )): ?>

         <h1><?php echo $thiscat_id; ?></h1>

       <?php elseif (is_tax( 'ranges_style' )): ?>

          <h1><?php echo $thiscat_id; ?></h1>

        <?php elseif (is_tax( 'ranges_type' )): ?>

           <h1><?php echo $thiscat_id; ?></h1>

        <?php elseif (is_archive('post')) : ?>

          <h1>Blog</h1>

       <?php elseif (is_page( 'ranges' )): ?>

          <h1>Choose A Range</h1>

      <?php elseif (isset($custom_title)) : ?>

        <h1><?php echo $custom_title; ?></h1>

      <?php elseif (is_home() || is_archive('posts') || is_singular('post')) : ?>

        <h1>Blog</h1>

      <?php elseif (is_search()): ?>

        <h1><?php printf( esc_html__( 'Search Results for: %s', 'starting-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

      <?php else : ?>

        <h1><?php the_title(); ?></h1>

      <?php endif; ?>
    </div>
    <div class="col-md-6 breadcrumbs">

      <?php if (is_tax( 'ranges_style' )): ?>


        <p id="breadcrumbs">
          <span>
            <span>
              <a href="http://staging.ulster.cornellstudios.com/">Home</a> |
              <span>
                <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/">Choose A Carpet</a> |
                <span>
                  <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/style/">Style</a> |
                  <span class="breadcrumb_last" aria-current="page">
                    <?php echo $thiscat_id; ?>
                  </span>
                </span>
            </span>
           </span>
         </span>
      </p>

    <?php elseif (is_tag()): ?>

      <?php
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      ?>

    <?php elseif (is_tax( 'ranges_colour' )): ?>


         <p id="breadcrumbs">
           <span>
             <span>
               <a href="http://staging.ulster.cornellstudios.com/">Home</a> |
               <span>
                 <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/">Choose A Carpet</a> |
                 <span>
                   <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/colour/">Colour</a> |
                   <span class="breadcrumb_last" aria-current="page">
                     <?php echo $thiscat_id; ?>
                   </span>
                 </span>
             </span>
           </span>Style
          </span>
       </p>

     <?php elseif (is_tax( 'ranges_type' )): ?>


          <p id="breadcrumbs">
            <span>
              <span>
                <a href="http://staging.ulster.cornellstudios.com/">Home</a> |
                <span>
                  <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/">Choose A Carpet</a> |
                  <span class="breadcrumb_last" aria-current="page">
                    <a href="http://staging.ulster.cornellstudios.com/ranges/">Range</a> |
                    <span class="breadcrumb_last" aria-current="page">
                      <?php echo $thiscat_id; ?>
                    </span>
                  </span>
              </span>
             </span>
           </span>
        </p>

     <?php elseif (is_page( 'ranges' )): ?>


          <p id="breadcrumbs">
            <span>
              <span>
                <a href="http://staging.ulster.cornellstudios.com/">Home</a> |
                <span>
                  <a href="http://staging.ulster.cornellstudios.com/choose-a-carpet/">Choose A Carpet</a> |
                  <span class="breadcrumb_last" aria-current="page">
                    Ranges
                  </span>
              </span>
             </span>
           </span>
        </p>



      <?php else : ?>

      <?php
        if ( function_exists('yoast_breadcrumb') ) {
          yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
        }
      ?>

      <?php endif; ?>
    </div>
  </div>
</div>

<?php if(is_home() || is_category()) : ?>
  <div class="sub-title">
    <div class="row">
      <div class="col-md-6 sub-title_content">
        <div class="row">
          <div class="col-md-6 col-lg-5">
            <div class="dropdown">
              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Filter: <strong><?php echo single_term_title(); ?></strong> <img src="<?php echo get_template_directory_uri() ?>/images/filter_dropicon.svg" alt="Filter by year ">
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li>
                  <a href="/blog/">View all</a>
                </li>
                <?php wp_list_categories(array( 'title_li' => '' )); ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6 pagination">
        <?php the_posts_pagination(
          array(
            'mid_size' => 2,
            'prev_text' => __( '<', 'textdomain' ),
            'next_text' => __( '>', 'textdomain' ),
            )); ?>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if(is_singular('post')) :

  $date = get_the_date('d.m.y');

  ?>
  <div class="sub-title">
    <div class="row">
      <div class="col-md-9 sub-title_content">

        <p><?php echo $date; ?> - <?php echo the_title(); ?></p>

      </div>
      <div class="col-md-3 back">
        <a href="<?php echo site_url(); ?>/blog">Back to blog</a>
      </div>
    </div>
  </div>
<?php endif ?>

<?php if(is_singular('gallery')) : ?>
  <div class="sub-title">
    <div class="row">
      <div class="col-md-12 back">

        <a href="<?php echo site_url(); ?>/gallery">Back to Gallery</a>

      </div>
    </div>
  </div>
<?php endif ?>



<?php if(is_post_type_archive('ulsterathome')) : ?>
  <div class="sub-title">
    <div class="row">
      <div class="col-md-12 sub-title_content">

        <strong>Be the inspiration</strong>

      </div>
    </div>
  </div>
  <div class="ulsterathome_intro">
    <h3>Do you have a beautiful Ulster carpet at home?</h3>
    <p>Inspire others with your own interior design style by adding your images to our gallery. <br />Tag us on Instagram, Facebook, Twitter or Pinstgram by using <a href="https://www.instagram.com/explore/tags/ulsterathome" target="_blank">#ulsterathome</a> or email your snaps to <a href="mailto:ulsterathome@ulstercarpets.com" target="_blank">ulsterathome@ulstercarpets.com</a> to feature in our excluse gallery and help inspire others.</p>
  </div>
<?php endif ?>

<?php if(is_singular('ulsterathome')) : ?>
  <div class="sub-title">
    <div class="row">
      <div class="col-md-12 sub-title_content">

        Customer Supplied Images

      </div>
    </div>
  </div>
<?php endif ?>
