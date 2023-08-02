<?php 
class Admin_Setting {
    public function init(){
         // Add a menu item for the settings page
         add_action('admin_menu', array($this, 'add_settings_page'));
    }    
    public function add_settings_page() {
        add_menu_page(
            'Referral Code Settings',
            'Referral Code',
            'manage_options',
            'referral-code-settings',
            array($this, 'generate_referral_code')
        );
    }
    public function generate_referral_code() {
      // Save the submitted settings
        if (isset($_POST['submit']) && current_user_can('manage_options')) {
            check_admin_referer('generate_referral_code_nonce');

            $generate_referral_code =  substr(md5(uniqid(mt_rand(), true)), 0, 8);

            update_option('generate_referral_code', $generate_referral_code);
        }
        $referral_code = get_option('generate_referral_code');
        // Display the settings page HTML
        ?>
        <div class="wrap">
            <h1>Referral Code Settings</h1>
            <form method="post" action="<?php echo esc_url(admin_url('admin.php?page=referral-code-settings')); ?>">
                <!-- Settings form fields go here -->
                <?php
                     wp_nonce_field('generate_referral_code_nonce');
                ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="generate_referral_code">Generate Referral Code</label></th>
                        <td>
                       
                            <input type="text" name="generate_referral_code" id="generate_referral_code" value="<?php echo esc_attr($referral_code); ?>">
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

}