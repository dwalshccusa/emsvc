<?php
/**
 * Plugin Name: Emsvc Subscribe
 * Plugin URI: http://enflyer.emsvc.net
 * Description: This plugin subscribes new users to your enflyer mail list
 * Version: 1.0.0
 * Author: Michael Cucaro
 * Author URI: http://enflyer.emsvc.net
 * License: GPL2
 */

add_action('wpmu_new_user', emsvc_subscribe);

function emsvc_subscribe($arg_user_id)
{
        $plugin_settings        = get_option('emsvc_s_settings');
        error_log(print_r($plugin_settings, true));
        $autoform_id            = $plugin_settings['emsvc_s_text_field_0'];
        $autoform_key           = $plugin_settings['emsvc_s_text_field_1'];

        error_log('plugin_settings - autoform_id: '     . $autoform_id);
        error_log('plugin_settings - autoform_key: '    . $autoform_key);

        $url     = 'http://winflyer.emsvc.com/autoform_display.php';

        error_log('subscribe called  user id ' . $arg_user_id);
        $user_data      = get_userdata($arg_user_id);
        $email          = $user_data->data->user_email;
        //$autoform_id  = 166;
        //$autoform_key = 'KaxpNbO';

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

add_action( 'admin_menu', 'emsvc_s_add_admin_menu' );
add_action( 'admin_init', 'emsvc_s_settings_init' );


function emsvc_s_add_admin_menu(  ) {

        add_options_page( 'Emsvc Subscribe', 'Emsvc Subscribe', 'manage_options', 'emsvc_subscribe', 'emsvc_s_options_page' );

}


function emsvc_s_settings_init(  ) {

        register_setting( 'pluginPage', 'emsvc_s_settings' );

        add_settings_section(
                'emsvc_s_pluginPage_section',
                __( 'Your section description', 'wordpress' ),
                'emsvc_s_settings_section_callback',
                'pluginPage'
        );

        add_settings_field(
                'emsvc_s_text_field_0',
                __( 'autoform id', 'wordpress' ),
                'emsvc_s_text_field_0_render',
                'pluginPage',
                'emsvc_s_pluginPage_section'
        );

        add_settings_field(
                'emsvc_s_text_field_1',
                __( 'autoform key', 'wordpress' ),
                'emsvc_s_text_field_1_render',
                'pluginPage',
                'emsvc_s_pluginPage_section'
        );


}


function emsvc_s_text_field_0_render(  ) {

        $options = get_option( 'emsvc_s_settings' );
        ?>
        <input type='text' name='emsvc_s_settings[emsvc_s_text_field_0]' value='<?php echo $options['emsvc_s_text_field_0']; ?>'>
        <?php

}


function emsvc_s_text_field_1_render(  ) {

        $options = get_option( 'emsvc_s_settings' );
        ?>
        <input type='text' name='emsvc_s_settings[emsvc_s_text_field_1]' value='<?php echo $options['emsvc_s_text_field_1']; ?>'>
        <?php

}


function emsvc_s_settings_section_callback(  ) {

        echo __( 'This section description', 'wordpress' );

}


function emsvc_s_options_page(  ) {

        ?>
        <form action='options.php' method='post'>

                <h2>Emsvc Subscribe</h2>

                <?php
                settings_fields( 'pluginPage' );
                do_settings_sections( 'pluginPage' );
                submit_button();
                ?>

        </form>
        <?php

}
?>
