<div class="col-md-6 faqs">
  <div class="row">
    <h2>Frequently asked Questions</h2>
  </div>

  <?php if( have_rows('faq') ): ?>

  	<?php $i = 1; while( have_rows('faq') ): the_row();

  		// vars
  		$question = get_sub_field('question');
  		$answer = get_sub_field('answer');

  		?>
      <div class="row faq">
      	<div class="col-xs-3 col-md-2 faqs_count matchheight">
          #<?php if($i < 9) : ?>0<?php endif; ?><?php echo $i ?>
        </div>

        <div class="col-xs-9 col-md-10 faqs_content matchheight">
          <p><?php echo $question ?></p>
          <p><?php echo $answer ?></p>
        </div>
      </div>

  	<?php $i++; endwhile; ?>
  <?php endif; ?>
</div>
