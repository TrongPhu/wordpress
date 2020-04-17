<?php if (!defined('ABSPATH')) exit; ?>
<div id="nboo-option-popup">
    <div class="nbd-popup-wrap" id="nboo-option-popup-overlay">
        <div class="nbd__pop__content">
            <div class="nbd__pop__content_wrapper">
                <div class="__content_wrapper">
                    <div class="content__header"><?php esc_html_e('How would you like to design your', 'web-to-print-online-designer'); ?> <b id="nboo-product-name"></b></div>
                    <div class="content__content">
                    <?php 
                        $nboo_archive_mode = true;
                        include('single-product/btn-upload-option.php');
                        include('single-product/btn-design-option.php'); 
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    <?php
        $upload_style = nbdesigner_get_option('nbdesigner_upload_popup_style', 's');
    ?>
    var nboo_design_url = "<?php echo getUrlPageNBD('create') ?>",
        nboo_upload_url = "<?php echo getUrlPageNBD( $upload_style == 's' ? 'simple_upload' : 'advanced_upload') ?>";
</script>