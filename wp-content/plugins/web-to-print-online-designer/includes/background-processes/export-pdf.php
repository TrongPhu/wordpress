<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class NBD_Export_PDF_Process extends WP_Background_Process {
    protected $action = 'nbd_export_pdf';

    public function __construct() {
        parent::__construct();
    }

    protected function task( $order_id ) {
        $order          = new WC_Order( $order_id );
        $order_items    = $order->get_items();
        foreach( $order_items AS $order_item_id => $order_item ){
            $nbd_item_key = wc_get_order_item_meta( $order_item_id, '_nbd' );
            if( $nbd_item_key ){
                nbd_export_pdfs( $nbd_item_key, false, false, 'no' );
                do_action( 'nbd_synchronize_output', $nbd_item_key, $order_id, $order_item_id );
            }
        }

        return false;
    }

    protected function complete() {
        parent::complete();
    }
}