<?php
/**
 * Plugin Name:Mapenzi Express
 * Plugin URI: https://github.com/shid94
 * Author: Rashid Migadde
 * Author URI: https://github.com/shid94
 * Description: Mapenzi Shiping Plugin
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: https://github.com/shid94
 * text-domain: mapenzi-express-shipping
*/
add_action ('woocommerce_shipping_init', 'mapenzi_grill_express_shipping_init');
function mapenzi_grill_express_shipping_init(){
    if(! class_exists('WC_MAPENZI_GRILL_EXPRESS_SHIPPING')){
        class WC_MAPENZI_GRILL_EXPRESS_SHIPPING extends WC_Shipping_Method{
            public function __construct(){
                $this->id  = 'mapenzi_express_shipping';
                $this->method_title =__('Mapenzi Express');
                $this->method_description = __( 'Mapenzi Grill Express Shipping'); // 
                $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
                $this->title              ="Mapenzi Grill Express Delivery";
                $this->init();
            }
            public function init(){
                // Load the settings API
            $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
            $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

            // Save settings in admin if you have any defined
            add_action ( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
            }
            public function calculate_shipping($package){
                $rate = array(
                    'label'    => $this->title,
                    'cost'     => '10000',
                    'calc_tax' => 'per_item'
                );
                
                // Register the rate
                $this->add_rate( $rate );
            }

        }

    }
}
add_filter('woocommerce_shipping_methods', 'add_mapenzi_express_method');
function add_mapenzi_express_method($methods){
    $methods['mapenzi_express_shipping']= 'WC_MAPENZI_GRILL_EXPRESS_SHIPPING';
    return $methods;
}
?>