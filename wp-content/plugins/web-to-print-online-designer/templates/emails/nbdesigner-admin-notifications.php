<?php if (!defined('ABSPATH')) exit; // Exit if accessed directly  ?>
<?php do_action('woocommerce_email_header', $heading); ?>
<p><?php esc_html_e('Please review orders below:', 'web-to-print-online-designer'); ?></p>
<?php if (is_array($orders)): ?>
    <ul>
    <?php foreach ($orders AS $order_id => $order_number): ?>
        <li><?php esc_html_e('View order', 'web-to-print-online-designer'); ?>: <a href="<?php echo admin_url("post.php?post=$order_id&action=edit"); ?>"><?php esc_html_e( $order_number ); ?></a></li>
    <?php endforeach; ?>
    </ul>
    <small><?php esc_html_e('Login is required to edit orders', 'web-to-print-online-designer'); ?></small>
<?php else: ?>
    <?php esc_html_e('No orders found', 'web-to-print-online-designer'); ?>
<?php endif; ?>
<?php do_action('woocommerce_email_footer');