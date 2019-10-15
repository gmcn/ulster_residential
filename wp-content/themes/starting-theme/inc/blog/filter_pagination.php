<div class="l-filter_pagination blog__filter_pagination">
  <div class="row">
    <div class="col-sm-6 e-filters">
      <?php $args = array(
        'show_option_none'   => 'Filter',
        'class'              => 'form-control',
      ); ?>
      <?php wp_dropdown_categories($args); ?>
      <script type="text/javascript">
        <!--
        var dropdown = document.getElementById("cat");

        function onCatChange() {
          if (dropdown.options[dropdown.selectedIndex].value > 0) {
            location.href = "<?php echo esc_url(home_url('/')); ?>?cat=" + dropdown.options[dropdown.selectedIndex].value;
          }
        }
        dropdown.onchange = onCatChange;
        -->
      </script>
    </div>
    <div class="col-sm-6 e-pagination">
      <?php $args = array(
        'prev_text'          => __('<svg fill="#ffffff" viewBox="0 0 32 32" class="icon icon-caret-left" viewBox="0 0 32 32" aria-hidden="true"><path d="M20.697 24L9.303 16.003 20.697 8z"/></svg>'),
        'next_text'          => __('<svg fill="#ffffff" viewBox="0 0 32 32" class="icon icon-caret-right" viewBox="0 0 32 32" aria-hidden="true"><path d="M11.303 8l11.394 7.997L11.303 24z"/></svg>'),
      ); ?>
      <?php echo paginate_links($args); ?>
    </div>
  </div>
</div>