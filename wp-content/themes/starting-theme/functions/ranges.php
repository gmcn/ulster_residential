<?php
add_image_size('small_thumbnail', 150, 150, false);
add_image_size('small_thumbnail-retina', 300, 300, false);
add_image_size('category_thumbnail', 400, 400, true);
add_image_size('category_thumbnail-retina', 800, 800, true);
add_image_size('square_thumbnail', 9999, 400, false);
add_image_size('square_thumbnail-retina', 9999, 800, false);
add_image_size('product_image', 1024, 99999, false);
add_image_size('product_image-retina', 2048, 99999, false);


function restOfRange($postid)
{
    $post_terms = wp_get_object_terms($postid, 'ranges_type', array('fields' => 'ids'));
    $args = array(
        'post_type' => 'ranges',
        'limit' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'ranges_type',
                'field' => 'term_id',
                'terms' => $post_terms,
            )
        ),
        'post__not_in' => array($postid)

    );
    $the_query = new WP_Query($args);
    return $the_query;
}

function fetchColors()
{
    $args = array(
        'post_type' => 'ranges',
        'limit' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'ranges_type',
                'field' => 'term_id',
                'terms' => $post_terms,
            )
        ),
        'post__not_in' => array($postid)

    );
    $the_query = new WP_Query($args);
    return $the_query;
}
