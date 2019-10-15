jQuery('.js-addToCart').click(function(e) {

        e.preventDefault();
        id = jQuery(this).data('id');
        var $source = jQuery(this);


        var data = {
                'action': 'addCart',
                'id': id
        };
        jQuery.post(cart_ajax_object.ajax_url, data, function(response) {
                if (response == 'limit') {
                        showAlert($source);
                } else {
                        processCartResponse(response);
                        jQuery($source).html('Product Sample added to cart');
                        jQuery($source).removeClass('e-btn--primary').addClass('e-btn--black');
                }
        });


        return false;

});
jQuery('.js-removeCart').click(function(e) {
        e.preventDefault();
        id = jQuery(this).data('id');

        var data = {
                'action': 'removeCart',
                'id': id
        };
        jQuery.post(cart_ajax_object.ajax_url, data, function(response) {
                processCartResponse(response);
                processRemoveCart(id);
                cartEmptyCheck();
        });


        return false;

});

function processCartResponse(data) {
        jQuery(".js-cartCount").html(data);
}

function processRemoveCart(id) {
        var x = document.getElementById(id);
        x.parentNode.removeChild(x);
}

function cartEmptyCheck() {
        var rowCount = jQuery('.basket__samples table tr').length;
        if (rowCount == 0) {
                //show the empty basket message
                jQuery(".js-basketEmpty").show();
                jQuery(".js-nextButton").hide();
        }
}

function showAlert() {
        var message = "Sorry you are limited to a maximum of 5 items";
        var status = "danger";
        var timeout = 5000;

        createAlert(message, status, timeout);
}