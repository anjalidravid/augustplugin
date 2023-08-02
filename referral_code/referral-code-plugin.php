<?php
/*
Plugin Name: Referral Code Plugin
Description: A simple referral code validation plugin.
Version: 1.0
Author: Anjali 
*/
class Referral_Code_Plugin {
    public function __construct() {

        // Initialize the shortcode class
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
   
        $Referral_Code_Shortcode =  new Referral_Code_Shortcode();
        $Referral_Code_Shortcode->init();

        $Admin_Setting =  new Admin_Setting();
        $Admin_Setting->init();

        $Custom_Table =  new Custom_Table();
        $Custom_Table->init();

        // $Referral_History_Table =  new Referral_History_Table();
        //  $Referral_History_Table->init();
    }

    public function enqueue_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('referral-code-validation', plugin_dir_url(__FILE__) . 'js/validation.js', array('jquery'), '1.0', true);

        wp_localize_script('referral-code-validation', 'referra_code_form', array(
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('referral-code-nonce')
        ));
    }
}
require plugin_dir_path(__FILE__) . 'includes/class-referral-code.php';
require plugin_dir_path(__FILE__) . 'includes/class-admin-setting.php';
require plugin_dir_path(__FILE__) . 'includes/class-custom-table.php';
// require plugin_dir_path(__FILE__) . 'includes/class-referral-history-table.php';


$referral_code_plugin = new Referral_Code_Plugin();
