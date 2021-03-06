<?php

/**
 * Loop through all carpet ranges as a grid
 *
 * @package Starting_Theme
 *
 */
?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <section class="l-singleRange">
            <div class="flex-row">
                <aside class="col l-singleRange__image">
                    <div class="l-singleRange__image--inner">
                        <?php
                                $thumb['1x'] = get_the_post_thumbnail_url(get_the_ID(), 'product_image');
                                $thumb['2x'] = get_the_post_thumbnail_url(get_the_ID(), 'product_image_retina');
                                ?>
                        <img src="<?php echo $thumb['1x']; ?>" srcset="<?php echo $thumb['1x']; ?> 1x, <?php echo $thumb['2x']; ?> 2x" alt="<?php the_title(); ?>">
                    </div>
                </aside>

                <article class="col">
                    <div class="l-singleRange__data u-pb--2">
                        <div class="l-singleRange__data-details  u-mb--8">
                          <div class="row u-pt--2">
                            <?php if ((get_field('colour') == get_the_title() ) && (get_the_title()) == get_the_title() ) : ?>
                            <?php else : ?>

                                  <div class="col-sm-4 u-text--600">
                                      Design
                                  </div>
                                  <div class="col-sm-8 u-text--large">
                                      <?php the_title(); ?>
                                  </div>

                            <?php endif; ?>
                          </div>

                            <div class="row">
                              <?php if (get_field('colour')) : ?>
                                <div class="col-sm-4 u-text--600">Colour</div>
                                <div class="col-sm-8 u-text--large">
                                  <?php the_field('colour'); ?>
                                </div>
                              <?php endif; ?>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 u-text--600">Design No.</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('design_no'); ?></div>
                            </div>
                            <?php $construction = get_field('construction');

                            if ($construction) :  ?>

                              <div class="row u-mt--4">
                                <div class="col-sm-4 u-text--600">Construction</div>
                                <div class="col-sm-8 u-text--large"><?php echo $construction ?></div>
                              </div>

                          <?php endif; ?>

                            <div class="row">
                                <div class="col-sm-4 u-text--600">Pile Content</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('pile_content'); ?></div>
                            </div>
                            <div class="row u-mt--4">
                                <div class="col-sm-4 u-text--600">Widths Available</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('widths_available'); ?></div>
                            </div>
                            <div class="row u-mt--4">
                                <div class="col-sm-4 u-text--600">Repeat Length</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('repeat_length'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 u-text--600">Repeat Type</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('repeat_type'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 u-text--600">Suitability</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('suitability'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 u-text--600">Tog Rating</div>
                                <div class="col-sm-8 u-text--large"><?php the_field('tog_value'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 u-text--600"></div>
                                <div class="col-sm-8 u-text--large"></div>
                            </div>
                        </div>
                        <div class="l-singleRange__data--action u-pb--2">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="u-bt--d u-pb--2"></div>
                                </div>
                                <div class="col-md-5 l-singleRange--addCart">
                                    <?php if (inCart($_SESSION['cart'], get_the_ID())) : ?>
                                        <a href="javascript:void(0);" class="e-btn e-btn--black e-btn--addToCart" data-id="<?php the_ID(); ?>">This Sample is Already Added</a>
                                    <?php else : ?>

                                      <?php if ( is_object_in_term( $post->ID, 'ranges_type', 'rug-bindings' ) ) : ?>

                                      <?php else: ?>

                                        <a href="#" class="e-btn e-btn--primary js-addToCart e-btn--addToCart" data-id="<?php the_ID(); ?>">Add this sample to my basket</a>

                                      <?php endif ?>

                                    <?php endif; ?>
                                </div>
                                <div class="col-md-7 text-right l-singleRange--shareBack">

                                    <span class="e-scrollDown"><img src="<?php asset('/images/scroll-icon_neutral.svg'); ?>"></span>
                                    <div class="e-btn c-shareThis u-text-up u-text--neutral">


                                      <div class="dropdown">
                                      <a class="toplevel" href="#" id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        + Share
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

                                    <?php if (false !== stripos($_SERVER['HTTP_REFERER'], "ranges_type")) : ?>

                                      <a href="<?php echo site_url('/choose-a-carpet/ranges/'); ?>" class="e-btn e-btn--neutral u-text-up e-btn--has-radius">Back to results</a>

                                    <?php elseif (false !== stripos($_SERVER['HTTP_REFERER'], "colour")) : ?>

                                      <a href="<?php echo site_url('/choose-a-carpet/colour/'); ?>" class="e-btn e-btn--neutral u-text-up e-btn--has-radius">Back to results</a>

                                    <?php elseif (false !== stripos($_SERVER['HTTP_REFERER'], "style")) : ?>

                                      <a href="<?php echo site_url('/choose-a-carpet/style/'); ?>" class="e-btn e-btn--neutral u-text-up e-btn--has-radius">Back to results</a>

                                    <?php else : ?>

                                      <a href="<?php echo site_url('/choose-a-carpet/ranges/'); ?>" class="e-btn e-btn--neutral u-text-up e-btn--has-radius">Back to results</a>

                                    <?php endif; ?>


                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </article>
            </div>
        </section>
    <?php endwhile; ?>
<?php endif; ?>
