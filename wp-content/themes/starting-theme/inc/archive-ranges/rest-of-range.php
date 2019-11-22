<?php
$restOfRange = restOfRange($post->ID);

if ($restOfRange->have_posts()) {
    ?>
    <h4>Other options available within this range:</h4>

    <div class="row">
        <div class="l-thumbGrid">
            <?php while ($restOfRange->have_posts()) {
                    $restOfRange->the_post();
                    include(locate_template("inc/archive-ranges/product-thumb.php"));
                } //endwhile
                ?>
        </div>
    </div>
<?php
} //endif
wp_reset_postdata();
?>
