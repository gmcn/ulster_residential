<?php if (paginate_links()) { ?>
  <div class="l-filter_pagination l-filter_pagination--footer ">
    <div class="row">
      <div class="col-sm-12 e-pagination">
        <?php $args = array(
            'prev_text'          => __('<svg fill="#ffffff" viewBox="0 0 32 32" class="icon icon-caret-left" viewBox="0 0 32 32" aria-hidden="true"><path d="M20.697 24L9.303 16.003 20.697 8z"/></svg>'),
            'next_text'          => __('<svg fill="#ffffff" viewBox="0 0 32 32" class="icon icon-caret-right" viewBox="0 0 32 32" aria-hidden="true"><path d="M11.303 8l11.394 7.997L11.303 24z"/></svg>'),
          ); ?>
        <?php echo paginate_links($args); ?>
      </div>
    </div>
  </div>
<?php } //end if paginate links
?>