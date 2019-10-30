<?php if( have_rows('offices') ): ?>
    <div class="container-fluid offices">
    	<div class="row">

    	<?php while( have_rows('offices') ): the_row();

    		// vars
    		$office_name = get_sub_field('office_name');
    		$office_phone = get_sub_field('office_phone_#');
        $office_email = get_sub_field('office_email');
        $office_fax = get_sub_field('office_fax_#');
    		$office_address = get_sub_field('office_address');
        $office_map = get_sub_field('office_map');

    		?>

        <div class="col-md-6 office wow fadeInDown">

          <div class="row">
            <div class="col-md-12">
              <h2><?php echo $office_name; ?></h2>
            </div>
            <div class="col-sm-5 col-lg-5 office_address matchheight">
              Ulster Carpets<br />
              <span><?php echo $office_name; ?></span>
              <?php echo $office_address; ?>
            </div>
            <div class="col-sm-6 col-lg-6 office_phone matchheight">
              <?php if ($office_email) : ?>
              <span>Email:</span><br  /> <a href="mailto:<?php echo $office_email ?>"><?php echo $office_email ?></a><br  />
              <?php endif; ?>
              <span>Tel:</span><br  /> <a href="tel:<?php echo $office_phone ?>"><?php echo $office_phone ?></a><br  />
              <?php if ($office_fax) : ?>
              <span>Fax:</span><br  /> <a href="tel:<?php echo $office_fax ?>"><?php echo $office_fax ?></a>
              <?php endif; ?>

            </div>
            <div class="col-md-12 office__map">
              <?php echo $office_map ?>
            </div>
          </div>
        </div>

    	<?php endwhile; ?>

    </div>
  </div>

<?php endif; ?>
