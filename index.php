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


function admin_panel() {
	add_menu_page(
		__( 'Custom Menu Title', 'textdomain' ),
		'Short Form',
		'manage_options',
		'myplugin/myplugin-admin.php',
        'admin_panel_callback',
        'dashicons-chart-pie',
		6
	);
}

add_action( 'admin_menu', 'admin_panel' );
  
function admin_panel_callback() {
    global $wpdb;
    $table_name ='short_form';
    $results = $wpdb->get_results( "SELECT * FROM $table_name", ARRAY_A);
    
    //print_r($results);

    echo '<div><h1>User Data Table</h1>';
    if ( !empty($results) ) {
        echo '<table class="widefat fixed">';
        echo '<thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Message</th></tr></thead>';
        echo '<tbody>';
        foreach ( $results as $result ) {
            echo '<tr>';
            echo '<td>' . esc_html( $result['id'] ) . '</td>';
            echo '<td>' . esc_html( $result['name'] ) . '</td>';
            echo '<td>' . esc_html( $result['email'] ) . '</td>';
            echo '<td>' . esc_html( $result['message'] ) . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo 'No data found.';
    }
    echo '</div>';

}

?>