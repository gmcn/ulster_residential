<?php
$custom_title = single_term_title("", false);
include(locate_template("inc/page-elements/title.php"));
include(locate_template("inc/archive-ranges/tax_filter_pagination.php"));


?>
<div class="blog">
    <div class="l-thumbGrid">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                include(locate_template("inc/archive-ranges/product-thumb.php"));
            endwhile;
        else : ?>
            <div class="col-sm-12 u-mt--6 u-mb--6">
                <h2>Sorry we can't find any carpet styles for your chosen filters.</h2>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include(locate_template("inc/blog/pagination.php")); ?>