<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

//add_action('widgets_init', 'add_left_sidebar');
//
//function add_left_sidebar()
//{
//    register_sidebar(array(
//        'name' => 'sidebar-left',
//        'before_widget' => '<div class="sidebar-box">',
//        'after_widget' => '</div>',
//        'before_title' => '<div class="widget-title">',
//        'after_title' => '</div>'
//    ));
//}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

// Test shortcode
function button_function($type)
{
    extract(shortcode_atts(array(
        'type' => 'type'
    ), $type));

    // check what type user entered
    switch ($type) {
        case 'twitter':
            return '<li><a href="http://twitter.com/filipstefansson" class="twitter-button">Follw me on Twitter!</a></li>';
            break;
        case 'rss':
            return '<li><a href="http://example.com/rss" class="rss-button">Subscribe to the feed!</a></li>';
            break;
    }
}

function register_button_shortcode()
{
    add_shortcode('button', 'button_function');
}

add_action('init', 'register_button_shortcode');


function get_all_post_incat($category_name)
{

    extract(shortcode_atts(array(
        'name' => 'name'
    ), $category_name['name']));

    $cat_name = $category_name['name'];

    $category_id = get_cat_ID($cat_name);

    $catquery = new WP_Query('cat=' . $category_id . '&posts_per_page=5');

    while ($catquery->have_posts()) :
        $catquery->the_post();
        ?>
        <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
        <?php
        wp_reset_postdata();
    endwhile;

}

function register_post_by_category()
{
    add_shortcode('category', 'get_all_post_incat');
}

add_action('init', 'register_post_by_category');