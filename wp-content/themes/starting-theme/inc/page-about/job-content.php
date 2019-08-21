<?php

  $job_title_extra = get_field('job_title_extra');
  $job_ref = get_field('job_ref');
  $job_location = get_field('job_location');
  $job_type = get_field('job_type');
  $closing_date = get_field('closing_date');
  $start_date = get_field('start_date');
  $salary = get_field('salary');
  $contract_duration = get_field('contract_duration');

 ?>

<div class="container-fluid career-single">
  <div class="row career">

    <div class="col-md-3 career__title matchheight wow fadeInLeft">
      <h3>The Job Specifics</h3>
    </div>

    <div class="col-md-9 matchheight wow fadeInLeft">

    </div>

    <div class="col-md-3 career__title matchheight wow fadeInLeft">
      <div class="career__title__wrapper bordermatch">
        <h2><?php the_title(); ?></h2>
        <p><?php echo $job_title_extra ?></p>
      </div>


      <div class="label">
        Start Date:
      </div>
      <p><?php echo $start_date ?></p>
      <div class="label">
        Salary:
      </div>
      <p><?php echo $salary ?></p>
      <div class="label">
        Contract Duration:
      </div>
      <p><?php echo $contract_duration ?></p>

      <div class="buttons">
        <a id="showForm" onclick="showform()">Apply Now</a>
      </div>

    </div>

    <div class="col-md-9 matchheight wow fadeIn">

      <div class="row career__details">
        <div class="career__details__wrapper bordermatch">
          <div class="col-xs-6 col-lg-3">
            <div class="label">
              REFERENCE:
            </div>
            <?php echo $job_ref ?>
          </div>
          <div class="col-xs-6 col-lg-3">
            <div class="label">
              LOCATION:
            </div>
            <?php echo $job_location ?>
          </div>
          <div class="col-xs-6 col-lg-3">
            <div class="label">
              TYPE:
            </div>
            <?php echo $job_type ?>
          </div>

          <?php if ($closing_date): ?>
            <div class="col-xs-6 col-lg-3">
              <div class="label">
                Closing Date:
              </div>
              <?php echo $closing_date  ?>
            </div>
          <?php endif; ?>
        </div>

      </div>

        <div class="row">


        <div id="career__content" class="col-md-12 career__content">
          <?php the_content() ?>
        </div>


        <div id="career__form" class="col-md-12 career__content" style="display: none;">
          <?php echo do_shortcode('[formidable id=4]') ?>
        </div>




      </div>

    </div>


    <!-- Modal -->
    <div id="application<?php echo $i ?>" class="modal  fade" role="dialog">
      <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <div class="row">
              <?php echo do_shortcode('[contact-form-7 id="165" title="Job Application"]') ?>
            </div>

          </div>
        </div>

      </div>
    </div>



  </div>

</div>
