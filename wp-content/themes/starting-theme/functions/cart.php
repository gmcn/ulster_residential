<?php
add_action('init', 'activate_session', 1);

function activate_session()
{
    if (!session_id()) {
        session_start();
    }
}
function cart_enqueue()
{

    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/js/cart.js', array('jquery'), null, true);
    wp_enqueue_script('alert-script', get_template_directory_uri() . '/js/alert.js');


    wp_localize_script(
        'ajax-script',
        'cart_ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'cart_enqueue');


//register ajax functions
add_action('wp_ajax_addCart', 'wpse_addCart');
add_action('wp_ajax_nopriv_addCart', 'wpse_addCart');
add_action('wp_ajax_removeCart', 'wpse_removeCart');
add_action('wp_ajax_nopriv_removeCart', 'wpse_removeCart');



//ajax add to cart
function wpse_addCart()
{
    $product_id = $_POST['id'];
    if (cartCount() == 5) {
        echo 'limit';
        die();
    }
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        if (!inCart($cart, $product_id)) {
            $cart = addToCart($cart, $product_id);
        }
        $_SESSION['cart'] = $cart;
    } else {
        $cart = $product_id . ',';
        $_SESSION['cart'] = $cart;
    }
    echo cartCount();

    die();
}

function wpse_removeCart()
{
    $product_id = $_POST['id'];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        if (inCart($cart, $product_id)) {
            $cart = removeFromCart($cart, $product_id);
        }
        $_SESSION['cart'] = $cart;
        // echo count($cart);
        echo cartCount();
    }
    die();
}

//return cart count
function cartCount()
{
    if (isset($_SESSION['cart'])) {
        return count(array_filter(explode(',', $_SESSION['cart'])));
    }
}

function addToCart($str, $item)
{
    $parts = explode(',', $str);
    $parts[] = $item;
    $parts = array_filter($parts);
    return implode(',', $parts);
}

function inCart($str, $value)
{
    $cart = explode(',', $str);
    if (in_array($value, $cart)) {
        return true;
    } else {
        return false;
    }
}

function removeFromCart($str, $item)
{
    $parts = explode(',', $str);

    while (($i = array_search($item, $parts)) !== false) {
        unset($parts[$i]);
    }

    return implode(',', $parts);
}
function destroyCart()
{
    unset($_SESSION['cart']);
}
function fetchCart()
{
    if (!isset($_SESSION['cart'])) {
        // no items in the cart - return false
        return false;
    } else {
        $cart_array = explode(',', $_SESSION['cart']);

        $args = array(
            'post_type' => array('ranges'),
            'post__in'      => $cart_array
        );
        // The Query
        return new WP_Query($args);
    }
}

function cartProcessOrder()
{
    $cart = fetchCart();
    $emailContent = 'You have received a new request for samples from:<br><br>';

    foreach ($_POST as $key => $post_value) {
        $key = str_replace('form_', '', $key);
        $key = ucfirst(str_replace('_', ' ', $key));
        $emailContent .= $key . ": " . strip_tags($post_value) . "<br>";
    }
    $emailContent .= "<br><br>";
    if ($cart->have_posts()) :

        while ($cart->have_posts()) : $cart->the_post();
            $range_types = (get_the_terms(get_the_ID(), 'ranges_type'));

            if (isset($range_types)) :
                $emailContent .= "Range: " . $range_types[0]->name . "<br>";
            endif;
            $emailContent .= "Design: " . get_the_title() . "<br>";
            $emailContent .= "Design No: " . get_field('design_no') . "<br><br>";

        endwhile; // endwhile
        wp_reset_postdata();
    endif;

    $to = 'uceurope@ulstercarpets.com, ucm.orders@ulstercarpets.com, gary@cornellstudios.com';
    $subject = 'Request for samples from the Ulster Carpets Website';
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: rachel@ulstercarpets.com');
    wp_mail($to, $subject, $emailContent, $headers);
    wp_redirect('basket/success');
}

function cartValidation()
{
    // validation rules
    $required = array('form_address_1', 'form_first_name', 'form_last_name', 'form_city');
    $validation = array();
    foreach ($_POST as $key => $post_value) {
        if (in_array($key, $required) && ($post_value == '')) {
            $validation['errors'][] = $key;
        }
    }
    if (count($validation['errors']) > 0) {
        $validation['result'] = false;
    } else {
        $validation['result'] = true;
    }
    return $validation;
}
