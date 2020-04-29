<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if(!class_exists('NB_ADMIN_PRODUCT_BUILDER')){

    class NB_ADMIN_PRODUCT_BUILDER {

        protected static $instance;

        public function __construct() {
            //todo something
        }

        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function init(){
            add_action('nbd_menu', array($this, 'tab_menu'));
            add_action('plugins_loaded', array($this, 'create_product_builder_table'));
            add_action('admin_enqueue_scripts', array($this, 'canvas_enqueue_scripts'), 30, 1);
        }

        public function tab_menu(){
            if(current_user_can('manage_nbd_tool')){
                $options_hook = add_submenu_page(
                    'nbdesigner', 'Products Builder', 'Products Builder', 'manage_nbd_tool', 'nb_product_builder', array($this, 'product_builder')
                );
                add_action( "load-$options_hook", array( $this, 'screen_option' ));
            }
        }

        public function product_builder(){

            if( isset( $_GET['action'] ) && $_GET['action'] != 'copy' ){


                require_once NBDESIGNER_PLUGIN_DIR . 'views/canvas-builder/edit-builder.php';
            }else{

                require_once NBDESIGNER_PLUGIN_DIR . 'includes/product-builder/product-builder-list.php';

                $nb_product_builder = new NB_Productbuilder_List_Table();

                include_once( NBDESIGNER_PLUGIN_DIR . 'views/canvas-builder/canvas-builder-list-table.php' );
            }
        }

        public function create_product_builder_table(){
            global $wpdb;
            $collate = '';
            if ( $wpdb->has_cap( 'collation' ) ) {
                $collate = $wpdb->get_charset_collate();
            }
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            if (NBDESIGNER_VERSION != get_option("nbdesigner_version_plugin")) {
                $tables =  "
                            CREATE TABLE IF NOT EXISTS {$wpdb->prefix}nb_product_builder ( 
                             id bigint(20) unsigned NOT NULL auto_increment,
                             title text NOT NULL,
                             priority  TINYINT(1) NOT NULL default 0, 
                             published  TINYINT(1) NOT NULL default 1, 
                             product_ids text NULL, 
                             product_cats text NULL,  
                             date_from TINYTEXT NULL,  
                             date_to TINYTEXT NULL,  
                             apply_for TINYTEXT NULL,  
                             enabled_roles text NULL,  
                             disabled_roles text NULL,  
                             created datetime NOT NULL default '0000-00-00 00:00:00',
                             modified datetime NOT NULL default '0000-00-00 00:00:00', 
                             created_by BIGINT(20) NULL, 
                             modified_by BIGINT(20) NULL,  
                             design longtext,
                             builder text NULL,
                             PRIMARY KEY  (id)
                            ) $collate; 
                          ";
                @dbDelta($tables);
            }
        }

        public function screen_option(){
            if( !isset( $_GET['action'] ) || $_GET['action'] == 'copy' ){
                $option = 'per_page';
                $args   = array(
                    'label'   => __('Products Builder', 'web-to-print-online-designer'),
                    'default' => 10,
                    'option'  => 'options_per_page'
                );
                add_screen_option( $option, $args );
            }
        }

        public function canvas_enqueue_scripts( $hook ){
            if( $hook == 'nbdesigner_page_nb_product_builder' ){
                wp_register_script('fabricjs', NBDESIGNER_JS_URL . 'fabric.js', array(), NBDESIGNER_VERSION);
                wp_register_style('nbd_options', NBDESIGNER_CSS_URL . 'admin-options.css', array('wp-color-picker'), NBDESIGNER_VERSION);
                wp_register_style('woocommerce-byd-layout', NBDESIGNER_CSS_URL . 'woocommerce-byd-layout.css', array('wp-color-picker'), NBDESIGNER_VERSION);
                wp_enqueue_script('nbd_options', NBDESIGNER_JS_URL . 'canvas-builder.js', array('jquery', 'jquery-ui-resizable', 'jquery-ui-draggable', 'jquery-ui-datepicker', 'jquery-ui-autocomplete', 'wp-color-picker', 'angularjs', 'wc-enhanced-select'), NBDESIGNER_VERSION);
                wp_enqueue_style(array('wp-jquery-ui-dialog', 'wp-color-picker', 'nbd_options','woocommerce-byd-layout'));
                wp_enqueue_script(array('wpdialogs', 'nbd_options','fabricjs'));
            }
        }

        public function get_option($id){
            global $wpdb;
            $sql = "SELECT * FROM {$wpdb->prefix}nb_product_builder";
            $sql .= " WHERE id = " . esc_sql($id);
            $result = $wpdb->get_results($sql, 'ARRAY_A');
            return count($result[0]) ? $result[0] : false;
        }
    }
}

$nbd_product_builder = NB_ADMIN_PRODUCT_BUILDER::instance();
$nbd_product_builder->init();