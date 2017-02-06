<?php
/**
 * Plugin Name: Emsvc Subscribe
 * Plugin URI: http://enflyer.emsvc.net
 * Description: This plugin subscribes new users to your enflyer mail list
 * Version: 1.0.0
 * Author: Michael Cuccaro
 * Author URI: http://enflyer.emsvc.net
 * License: GPL2
 */

add_action('wpmu_new_user', emsvc_subscribe);

function emsvc_subscribe($arg_user_id)
{
        $url     = 'https://enflyer.emsvc.net/autoform_display.php';

        error_log('subscribe called  user id ' . $arg_user_id);
        $user_data      = get_userdata($arg_user_id);
        $email          = $user_data->data->user_email;
        $autoform_id    = ###;  //some autoform number
        $autoform_key   = '$$$'; //some autoform key string

        $args =         array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array( 'fields[autoform_id]' => $autoform_id, 'fields[af_key]' => $autoform_key, 'action' => 'add', 'fields[email]' => $email),
        'cookies' => array()
        );

        $response = wp_remote_post( $url, $args);
}
?>
