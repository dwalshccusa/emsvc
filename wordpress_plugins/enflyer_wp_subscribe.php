<?php
/**
 * Plugin Name: Enflyer Subscribe
 * Plugin URI: http://www.enflyer.com
 * Description: When the Enflyer Subscription plugin is enabled, all valid users who signup for your site will be immedaitely subscribed to your Enflyer memberlist via a hidden signup for that you have set up in your Enflyer account.
 * Version: 1.0.0
 * Author: Michael Cuccaro
 * Author URI: http://github.com/mvcuccaro
 * License: GPL2
 */

add_action('wpmu_new_user', enflyer_subscribe);

function enflyer_subscribe($arg_user_id)
{
        $plugin_settings        = get_option('enflyer_s_settings');
        error_log(print_r($plugin_settings, true));
        $autoform_id            = $plugin_settings['enflyer_s_text_field_0'];
        $autoform_key           = $plugin_settings['enflyer_s_text_field_1'];

        error_log('plugin_settings - autoform_id: '     . $autoform_id);
        error_log('plugin_settings - autoform_key: '    . $autoform_key);

        $url     = 'http://winflyer.enflyer.com/autoform_display.php';

        error_log('subscribe called  user id ' . $arg_user_id);
        $user_data      = get_userdata($arg_user_id);
        $email          = $user_data->data->user_email;
        //$autoform_id  = 166;
        //$autoform_key = 'KaxpNbO';

        $args =         array(
        'method' => 'POST',
        'timeout' => 10,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(),
        'body' => array( 'fields[autoform_id]' => $autoform_id, 'fields[af_key]' => $autoform_key, 'action' => 'add', 'fields[email]' => $email),
        'cookies' => array()
        );

        $response = wp_remote_post( $url, $args);
}

add_action( 'admin_menu', 'enflyer_s_add_admin_menu' );
add_action( 'admin_init', 'enflyer_s_settings_init' );


function enflyer_s_add_admin_menu(  ) {

        add_options_page( 'Enflyer Subscribe', 'Enflyer Subscribe', 'manage_options', 'enflyer_subscribe', 'enflyer_s_options_page' );

}


function enflyer_s_settings_init(  ) {

        register_setting( 'pluginPage', 'enflyer_s_settings' );

        add_settings_section(
                'enflyer_s_pluginPage_section',
                __( 'When the Enflyer Subscription plugin is enabled, all valid users who signup for your site will be immedaitely subscribed to your Enflyer memberlist via a hidden signup for that you have set up in your Enflyer account.', 'wordpress' ),
                'enflyer_s_settings_section_callback',
                'pluginPage'
        );

        add_settings_field(
                'enflyer_s_text_field_0',
                __( 'autoform id', 'wordpress' ),
                'enflyer_s_text_field_0_render',
                'pluginPage',
                'enflyer_s_pluginPage_section'
        );

        add_settings_field(
                'enflyer_s_text_field_1',
                __( 'autoform key', 'wordpress' ),
                'enflyer_s_text_field_1_render',
                'pluginPage',
                'enflyer_s_pluginPage_section'
        );


}


function enflyer_s_text_field_0_render(  ) {

        $options = get_option( 'enflyer_s_settings' );
        ?>
        <input type='text' name='enflyer_s_settings[enflyer_s_text_field_0]' value='<?php echo $options['enflyer_s_text_field_0']; ?>'>
        <?php

}


function enflyer_s_text_field_1_render(  ) {

        $options = get_option( 'enflyer_s_settings' );
        ?>
        <input type='text' name='enflyer_s_settings[enflyer_s_text_field_1]' value='<?php echo $options['enflyer_s_text_field_1']; ?>'>
        <?php

}


function enflyer_s_settings_section_callback(  ) {

        echo __( 'The autoform id and autoform key are required for subscribing a member to an autoform (sign up form)', 'wordpress' );

}


function enflyer_s_options_page(  ) {

        ?>
        <form action='options.php' method='post'>

                <h2>Enflyer Subscribe</h2>

                <?php
                settings_fields( 'pluginPage' );
                do_settings_sections( 'pluginPage' );
                submit_button();
                ?>

        </form>
        <?php

}
?>
