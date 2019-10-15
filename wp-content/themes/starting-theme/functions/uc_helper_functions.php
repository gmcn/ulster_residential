<?php

function randomColor()
{
    $colors = array(
        "#C37575",
        "#A08B8B",
        "#9CB4B2",
        "#B6BA9F",
        "#AC90A0",
        "#C6C2C2",
        "#5A6962"
    );
    // get random index from array $arrX
    $randIndex = array_rand($colors);

    // output the value for the random index
    return 'style="background-color:' . $colors[$randIndex] . '"';
}


function generateBackLink($fallbackPage = null)
{
    $referer = $_SERVER['HTTP_REFERER'];
    $domain = parse_url($referer);
    if ($domain['host'] == $_SERVER['SERVER_NAME']) {
        return $referer;
    } else {
        if ($fallbackPage) {
            return site_url($fallbackPage);
        } else {
            return esc_url(home_url('/'));
        }
    }
}

function uc_get_related_posts($post_id, $related_count, $args = array())
{
    $terms = get_the_terms($post_id, 'category');

    if (empty($terms)) $terms = array();

    $term_list = wp_list_pluck($terms, 'slug');

    $related_args = array(
        'post_type' => 'post',
        'posts_per_page' => $related_count,
        'post_status' => 'publish',
        'post__not_in' => array($post_id),
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field' => 'slug',
                'terms' => $term_list
            )
        )
    );

    return new WP_Query($related_args);
}


function uc_getPostsComingUp($date, $count = 3)
{

    $args = array(
        'date_query' => array(
            array(
                'before' => $date
            ),
        ),
        'posts_per_page' => 10,
    );
    return new WP_Query($args);
}


function asset($url = null)
{
    echo bloginfo('template_directory') . $url;
}


function listRangeColors($colors)
{
    if ($colors) {
        $lastElement = end($colors);

        foreach ($colors as $color) :
            echo $color->name;

            if ($lastElement->slug != $color->slug) echo ', ';
        endforeach;
    }
}



function swatchThumbnail($post_id, $thumbnail_size = 'square_thumbnail')
{

    $thumb['1x'] = get_the_post_thumbnail_url($post_id, $thumbnail_size);

    $imgdata = wp_get_attachment_image_src(get_post_thumbnail_id(), $thumbnail_size . '-retina'); //change thumbnail to whatever size you are using


    $wanted_dimensions = getWantedDimensions($thumbnail_size . '-retina'); //change this to your liking

    if ($imgdata[1] > $wanted_dimensions['width'] && $imgdata[2] > $wanted_dimensions['height']) {
        $thumb['2x'] = get_the_post_thumbnail_url(get_the_ID(), $thumbnail_size . '-retina');
    } else {
        unset($thumb['2x']);
    }
    if (isset($thumb['2x'])) {
        echo '<img src="' . $thumb['1x'] . '" srcset="' . $thumb['1x'] . ' 1x, ' . $thumb['2x'] . ' 2x" alt="' . get_the_title($post_id) . '">';
    } else {
        echo '<img src="' . $thumb['1x'] . '" alt="' . get_the_title($post_id) . '">';
    }
}


function getWantedDimensions($thumbnail_size = 'square_thumbnail')
{

    $image_sizes = wp_get_additional_image_sizes();

    if (isset($image_sizes[$thumbnail_size])) {
        return $image_sizes[$thumbnail_size];
    }
}



function isValid($field_name = null, $validation = null)
{
    // checks if supplied fieldname has 
    // failed validation and returns appr
    // classes if so

    if (in_array($field_name, $validation['errors'])) {
        echo ' has-error';
    }
    return false;
}

function initialFilterLabel($ranges_type)
{
    echo ucfirst(taxToKey($ranges_type));
}

function filterLogic($ranges_type, $filter_array)
{
    switch ($tax_slug) {
        case 'ranges_style':
            return 'style';
            break;
        case 'ranges_colour':
            return 'colour';
            break;
        default:
            return 'range';
            break;
    }
}
function taxToKey($tax_slug)
{
    switch ($tax_slug) {
        case 'ranges_style':
            return 'style';
            break;
        case 'ranges_colour':
            return 'colour';
            break;
        default:
            return 'range';
            break;
    }
}
function keytoTax($tax_slug)
{
    switch ($tax_slug) {
        case 'style':
            return 'ranges_style';
            break;
        case 'colour':
            return 'ranges_colour';
            break;
        default:
            return 'ranges_type';
            break;
    }
}
function taxToPath($tax_slug)
{
    switch ($tax_slug) {
        case 'ranges_style':
            return 'style';
            break;
        case 'ranges_colour':
            return 'colour';
            break;
        default:
            return 'ranges';
            break;
    }
}

function activeFilterLabel($ranges_type)
{
    // find selected value for $ranges_type
    // echo out
}

function getUrlParams($new_param, $new_value, $base_url)
{
    $querystring = '';
    $keyinserted = false;
    // go through all current url params
    foreach ($_GET as $key => $value) {
        if ($querystring == '') {
            $querystring .= '?';
        } else {
            $querystring .= '&';
        }

        if ($key == $new_param) {
            $querystring .= $new_param . '=' . $new_value;
            $keyinserted = true;
        } else {
            $querystring .= $key . '=' . $value;
        }
    }
    if (!$keyinserted) {
        //if flag isn't true
        //add key and value to end of url query string
        if ($querystring == '') {
            $querystring .= '?';
        } else {
            $querystring .= '&';
        }
        $querystring .= $new_param . '=' . $new_value;
    }
    echo $base_url . $querystring;
}


function removeUrlParams($new_param, $base_url)
{
    $querystring = '';
    // go through all current url params
    foreach ($_GET as $key => $value) {
        if ($key != $new_param) {

            if ($querystring == '') {
                $querystring .= '?';
            } else {
                $querystring .= '&';
            }

            $querystring .= $key . '=' . $value;
        }
    }
    echo $base_url . $querystring;
}
