<?php 
class Referral_Code_Shortcode {

    public function __construct() {
       
    }
    public function init(){
        add_shortcode('referral_code_form', array($this, 'render_referral_code_form'));
        add_action('wp_ajax_validate_referral_code', array($this, 'validate_referral_code'));
        add_action('wp_ajax_nopriv_validate_referral_code', array($this, 'validate_referral_code'));
    }    
    public function render_referral_code_form(){ ?>
       <form id="referral-registration-form">
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" id="first_name" >
            
            <label for="last_name">Last Name:</label>
            <input type="text" name="last_name" id="last_name" >
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" >
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" >
            
            <label for="referral_code">Referral Code:</label>
            <input type="text" name="referral_code" id="referral_code" >
            <span id="referral-code-validation-message"></span>
            <button type="submit" class="submit-button"  id="user_message_send">Register</button>
            <!-- <input type="submit" value="Register"> -->
        </form>
   <?php }
  
    public function validate_referral_code() {
        global $wpdb;
        $referral_code = get_option('generate_referral_code');
        if($_POST['referral_code'] !=  $referral_code ){
            echo '<span class="incorrect-sign">&#10008; Incorrect Referral Code</span>';
        }else{
            $data = array(
                'first_name'=>$_POST['first_name'],
                'last_name'=>$_POST['last_name'],
                'email'=>$_POST['email'],
                'password'=>$_POST['password'],
                'referral_code'=>$_POST['referral_code'],
            );
            $table_name = $wpdb->prefix . 'referral_users';
            $wpdb->insert( $table_name, $data);
        }
        exit;
   }
}
