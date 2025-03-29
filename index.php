<?php

/*
 * Plugin Name:       Short Form
 * Description:       This plugin used for collect user inputs.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Bristy
 * Text Domain:       sf
*/

function shortcode_form(){
   
    if (!empty($_POST)) {
        global $wpdb;
        $table = 'short_form';
        $data = array(
            'name'      => sanitize_text_field($_POST['uname']),
            'email'     => sanitize_email($_POST['uemail']),
            'message'   => sanitize_textarea_field($_POST['umessage'])
        );
        $format = array(
            '%s',
            '%s',
            '%s'
        );
        $wpdb->insert( $table, $data, $format );
       
    } 
   
   
   
   
?>
    <form action="" method="post">
        <h2>Short Form</h2>
        <label for="">Name:</label>
        <input type="text" placeholder="Please enter your name" name="uname">
        <br> <br>
        <label for="">Email:</label>
        <input type="email" placeholder="Please enter your email" name="uemail">
        <br> <br>
        <label for="">Message:</label>
        <textarea id="" placeholder="message" name="umessage"></textarea>
        <br> <br>
        <input type="submit">
    </form>

<?php

   
    
}
  
  
add_shortcode('short_form', 'shortcode_form');
  


?>