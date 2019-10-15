( function($) {

  $('.bxslider').bxSlider({
   infiniteLoop: true,
   minSlides: 1,
   maxSlides: 1,
   pager: true,
   auto: true,
   speed: 1500,
   controls: false,
   touchEnabled: false,
   pause: 7500,
   });

  /**
   * Match Height (Including Safari onload fix)
   */
  function startMatchHeight() {
    $('.matchheight').matchHeight();
    $('.imgmatchheight').matchHeight();
    $('.hmatchheight').matchHeight();
    $('.bordermatch').matchHeight();
  }
  window.onload = startMatchHeight;

  $(function() {
    $('#bh-sl-map-container').storeLocator();
  });

  $(document).ready(function() {
    $(".fancybox").fancybox({
      infobar: true,
      helpers : {
       title: { type: 'inside'}
      },
      afterLoad: function(){
       this.title = this.title + ' <p> ' + $(this.element).find('img').attr('alt');
      }
      }); // fancybox

    }); // ready

    $(".image-show").fancybox({
      infobar: true,
      helpers : {
       title: { type: 'inside'}
      },
      afterLoad: function(){
       this.title = this.title + ' <p> ' + $(this.element).find('img').attr('alt');
      }
    });

    $('.open-album').click(function(e) {
        var el, id = $(this).data('open-id');
        if(id){
            el = $('.image-show[rel=' + id + ']:eq(0)');
            e.preventDefault();
            el.click();
        }
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

  jQuery('button').click( function(e) {
    jQuery('.collapse').collapse('hide');
});

} ) (jQuery);

function showform() {
  var x = document.getElementById("career__content");
  var y = document.getElementById("career__form");
  var z = document.getElementById("showForm");

    if (x.style.display === "none") {
      x.style.display = "block";
      y.style.display = "none";
    } else {
      x.style.display = "none";
      y.style.display = "block";
      z.style.display = "none";
    }

}

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




window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#31404e",
      "text": "#aaaeb2"
    },
    "button": {
      "background": "#14191f"
    }
  },
  "theme": "edgeless",
  "position": "top",
  "static": true,
  "content": {
    "message": "This site uses cookies. By continuing to browse the site, you are agreeing to our use of cookies.",
    "dismiss": "Close This",
    "link": "Find out more",
    "href": "data-policy"
  }
});
