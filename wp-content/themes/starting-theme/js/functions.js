( function($) {

  /**
   * Match Height (Including Safari onload fix)
   */
  function startMatchHeight() {
    $('.matchheight').matchHeight();
  }
  window.onload = startMatchHeight;

  $(document).ready(function() {
  		$(".fancybox").fancybox();
  	});

    $('.accordion > li > a').click(function(){
      if ($(this).attr('class') != 'active'){
        $('.accordion li ul').slideUp();
        $(this).next().slideToggle();
        $('.accordion li a').removeClass('active');
        $(this).addClass('active');
      } else {
        $('.accordion li ul').slideUp();
        $('.accordion li a').removeClass('active');
      }
    });

} ) (jQuery);

/* Set the width of the side navigation to 300px */
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("mySidenav").style.marginRight = "0";
}

/* Set the width of the side navigation to -300px */
function closeNav() {
  document.getElementById("mySidenav").style.marginRight = "-300px";
  document.getElementById("mySidenav").style.width = "300px";
}

// /* Open when someone clicks on the span element */
function openNewsletter() {
    document.getElementById("myNewsletter").style.height = "100%";
    document.getElementById("mySidenav").style.marginRight = "-300px";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeNewsletter() {
    document.getElementById("myNewsletter").style.height = "0%";
}

// /* Open when someone clicks on the span element */
function openSearch() {
    document.getElementById("mySearch").style.height = "100%";
    document.getElementById("mySidenav").style.marginRight = "-300px";
}

/* Close when someone clicks on the "x" symbol inside the overlay */
function closeSearch() {
    document.getElementById("mySearch").style.height = "0%";
}
