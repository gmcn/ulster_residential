<div class="container-fluid stockists">

    <h2>find a stockist</h2>
    <p>Ulster Carpets is stocked across the world. Simply click on your region below and enter a few simple details to find your nearest stockist.</p>

    <div class="collapse" id="collapseUK">
      <div class="row">
        <div class="stockists_locations">

          <div class="bh-sl-container container">

            <div class="bh-sl-form-container">
              <form id="bh-sl-user-location" method="post" action="#">

                  <div class="form-input">
                    <label for="bh-sl-address">Search your Town or Postcode</label>
                    <input type="text" id="bh-sl-address" name="bh-sl-address" placeholder="Location goes here" />
                  </div>

                  <button id="bh-sl-submit" onclick="document.location+='#stockistResults';"  type="submit">Submit</button>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  <div class="row stockists_locations clear">
    <div class="col-md-3 stockists_locations__location matchheight">
      <h4>UK <span>&</span> Ireland</h4>
      <p>United Kingdom & Ireland</p>

      <button type="button" data-toggle="collapse" data-target="#collapseUK" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

    </div>
    <div class="col-md-3 stockists_locations__location matchheight">
      <h4>EU</h4>
      <p>European Union</p>

      <button class="hidden-xs hidden-sm" type="button" data-toggle="collapse" data-target="#collapseEU" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

      <button class="hidden-md hidden-lg" type="button" data-toggle="collapse" data-target="#collapseEU_mobile" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

      <div class="collapse hidden-md hidden-lg" id="collapseEU_mobile">
        <div class="row">
          <div class="stockists_locations">
            <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
            <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
            <div style="clear:both"></div>
          </div>
        </div>
      </div>

    </div>
    <div class="col-md-3 stockists_locations__location matchheight">
      <h4>USA</h4>
      <p>United States of America</p>

      <button class="hidden-xs hidden-sm" type="button" data-toggle="collapse" data-target="#collapseUS" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

      <button class="hidden-md hidden-lg" type="button" data-toggle="collapse" data-target="#collapseUS_mobile" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

      <div class="collapse hidden-md hidden-lg" id="collapseUS_mobile">
        <div class="row">
          <div class="stockists_locations">
            <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
            <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
            <div style="clear:both"></div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-md-3 stockists_locations__location matchheight">
      <h4>Rest <span>of</span> World</h4>
      <p>Rest of the World</p>

      <button class="hidden-xs hidden-sm" type="button" data-toggle="collapse" data-target="#collapseROW" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>

      <button class="hidden-md hidden-lg" type="button" data-toggle="collapse" data-target="#collapseROW_mobile" aria-expanded="false" aria-controls="collapseExample">
        Find me a store
      </button>


      <div class="collapse hidden-md hidden-lg" id="collapseROW_mobile">
        <div class="row">
          <div class="stockists_locations">
            <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
            <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
            <div style="clear:both"></div>
          </div>
        </div>
      </div>

    </div>

  </div>

  <div class="collapse hidden-xs hidden-sm" id="collapseEU">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

  <div class="collapse" id="collapseUS">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

  <div class="collapse" id="collapseROW">
    <div class="row">
      <div class="stockists_locations">
        <p class="">Email us now to find out how to purchase on <a href="mailto:info@ulstercarpets.com">info@ulstercarpets.com</a> or using the form below.</p>
        <?php echo do_shortcode('[contact-form-7 id="98" title="Find A Stockist"]'); ?>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>

<a name="stockistResults"></a>

</div>


<div class="bh-sl-container">



  <div id="bh-sl-map-container" class="bh-sl-map-container">
    <div id="bh-sl-map" class="bh-sl-map" style="display: none;"></div>
    <div class="bh-sl-loc-list">
      <h1>Results</h1>
      <div class="row th hidden-xs hidden-sm">

        <div class="col-md-2">
          Name
        </div>

        <div class="col-md-4">
          Address
          <span>(click pointer to view google maps in separate window)</span>
        </div>

        <div class="col-md-2">

        </div>

        <div class="col-md-2">
          Phone
        </div>

        <div class="col-md-2">
          Website
        </div>
      </div>

      <ul class="list"></ul>

    </div>
  </div>
</div>




<script src="https://maps.google.com/maps/api/js?key=AIzaSyAfU2hsPF_D_DwXwxr8QEk2NU_RPzBO4YA"></script>
