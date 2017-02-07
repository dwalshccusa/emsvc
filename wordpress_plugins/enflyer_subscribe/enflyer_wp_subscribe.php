<?php
/**
 * Plugin Name: Enflyer Subscribe
 * Plugin URI: http://www.enflyer.com
 * Description: When the Enflyer Subscription plugin is enabled, all valid users who signup for your site will be immedaitely subscribed to your Enflyer memberlist via a hidden signup for that you have set up in your Enflyer account.
 * Version: 1.0.0
 * Author: Michael Cuccaro
 * Author URI: https://github.com/mvcuccaro
 * License: GPL2
 */

add_action('wpmu_new_user', enflyer_subscribe);

function enflyer_subscribe($arg_user_id)
{
        $url    = 'https://enflyer.emsvc.net/autoform_display.php'; //the location of the enflyer submission form

        /**
        * retrieve plugin settings
        */
        $plugin_settings        = get_option('enflyer_s_settings');
        $autoform_id            = $plugin_settings['enflyer_s_text_field_0'];   //the unique id of the enflyer autoform
        $autoform_key           = $plugin_settings['enflyer_s_text_field_1'];   //the validation key of the enflyer autoform
        error_log('plugin_settings - autoform_id: '     . $autoform_id);
        error_log('plugin_settings - autoform_key: '    . $autoform_key);

        /**
        * retrieve the user email from the wordpress user record
        */
        $user_data      = get_userdata($arg_user_id);
        $email          = $user_data->data->user_email;

        /**
        * submit data to enflyer autoform
        */
        $args =         array(
                                'method' => 'POST',
                                'timeout' => 20,
                                'redirection' => 5,
                                'httpversion' => '1.0',
                                'blocking' => true,
                                'headers' => array(),
                                'body' => array( 'fields[autoform_id]' => $autoform_id, 'fields[af_key]' => $autoform_key, 'action' => 'add', 'fields[email]' => $email),
                                'cookies' => array()
                        );

        $response = wp_remote_post( $url, $args);

        /**
        * handle response
        */
        if( is_wp_error($response) )
        {
                $error_message = $response->get_error_message();
                error_log('enflyer subscribe - Something went wrong: ' .  $error_message);
                error_log('Response: ' . print_r($response, true));
        }
        else
        {
                error_log('enflyer subscribe success');
        }
}


/**
* Begin Plugin Settings
* thanks to http://wpsettingsapi.jeroensormani.com/ for making it easy to generate plugin settings code.
*/
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
