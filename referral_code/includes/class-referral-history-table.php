<?php 
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Referral_History_Table extends WP_List_Table {
    
    public function __construct() {
        parent::__construct(array(
            'singular' => 'referral',
            'plural' => 'referrals',
            'ajax' => false
        ));
    }

    public function get_columns() {
        return array(
            'username' => 'Username',
            'referral_user' => 'Referral User',
            'join_commission' => 'Join Commission',
            'actions' => 'Actions'
        );
    }

    // Populate table data (sample data, replace with actual data)
    public function prepare_items() {
        $columns = $this->get_columns();
        $data = array(
            array(
                'username' => 'John Doe',
                'referral_user' => 'Jane Smith',
                'join_commission' => '₹100',
                'actions' => '<a href="#">Edit</a> | <a href="#">Delete</a>'
            ),
            // Add more data rows as needed
        );

        $this->_column_headers = array($columns, array(), array());
        $this->items = $data;
    }

    public function column_default($item, $column_name) {
        return isset($item[$column_name]) ? $item[$column_name] : '';
    }

    public function column_actions($item) {
        return $item['actions'];
    }
}

// Function to set up the admin menu
function my_plugin_admin_menu() {
    add_menu_page(
        'Referral History',
        'Referral History',
        'manage_options',
        'referral-history',
        'render_referral_history_table'
    );
}

// Function to render the custom list table
function render_referral_history_table() {
    $referral_history_table = new Referral_History_Table();
    $referral_history_table->prepare_items();
    
    echo '<div class="wrap"><h2>Referral History</h2>';
    $referral_history_table->display();
    echo '</div>';
}

// Hook into the admin menu to register the menu page and render the list table
add_action( 'admin_menu', 'my_plugin_admin_menu' );
