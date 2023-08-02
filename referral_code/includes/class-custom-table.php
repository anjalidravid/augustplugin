<?php 
class Custom_Table {
    public function init(){
        register_activation_hook(__FILE__, array($this, 'create_custom_referral_table'));
    } 
    public function create_custom_referral_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'referral_users';

        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            first_name VARCHAR(255) NOT NULL,
            last_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            referral_code VARCHAR(50) NOT NULL,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);
    }

}