<?php
defined('ABSPATH') or die('Access Denied!');

add_action('wp_head', 'add_meta_tag');

add_action('wp_enqueue_scripts', function () {
    if (is_page('panel') || is_page('purchase') || is_page('rules')) {
        wp_enqueue_script('nitro-main', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/nitro-main.js', ['jquery', 'table'], NCP_VER, true);
        ncp_dequeue_scripts();
    }
    if (is_page('login-register')) {
        wp_enqueue_script('nitro-login', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/login.js', ['jquery'], NCP_VER, true);
        wp_enqueue_script('recaptcha-enterprise', 'https://www.google.com/recaptcha/enterprise.js?render=6LdzJvEpAAAAAIDr7heFS3Nlznm1qNHgI6u_YOsK', array(), null, true);
        wp_enqueue_style('nitro-login', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/login.css', '', NCP_VER);
        wp_localize_script('nitro-login', 'ajax_filter_params', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'siteUrl' => home_url(),
            'nonce' => wp_create_nonce('my_ajax_nonce'),
        ]);
        ncp_dequeue_scripts();
    }
    if (is_page('support')) {
        wp_enqueue_style('nitro-login', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/support.css');
    }
    wp_enqueue_style('nitro-main', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/nitro-main.css', '', NCP_VER);
    wp_enqueue_style('toastify', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/toastify.min.css');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', ['jquery'], null, true);
    wp_enqueue_script('toastify', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/toastify.js', ['jquery'], null, true);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
    wp_enqueue_script('table', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/table.js', ['jquery'], NCP_VER, false);
    wp_enqueue_style('table', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/table.css');
    wp_localize_script('nitro-main', 'ajax_filter_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'siteUrl' => home_url(),
        'nonce' => wp_create_nonce('my_ajax_nonce'),
    ]);
    if (is_front_page() || is_page('plans') || is_page('rules') || is_page('faq')) {
        wp_enqueue_script('home', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/home.js', ['jquery', 'swiper'], null, true);
        wp_enqueue_script('swiper', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/swiper-bundle.min.js', [], null);
        wp_localize_script('home', 'ajax_filter_params', [
            'ajax_url' => admin_url('admin-ajax.php'),
            'siteUrl' => home_url(),
            'nonce' => wp_create_nonce('my_ajax_nonce'),
        ]);
    }

    if (is_front_page() || is_page('panel')) {
        // Enqueue new Persian datepicker script and stylesheet
        wp_enqueue_style('jalalidatepickercss', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/jalalidatepicker.min.css');
        wp_enqueue_script('jalalidatepicker', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/jalalidatepicker.min.js', [], NCP_VER, true);
    }

    wp_enqueue_script('hs-slider', NCP_PLUGIN_INCLUDES_URL . 'front-assets/js/hs-slider.js', [], null, true);
    wp_enqueue_style('hs-slider', NCP_PLUGIN_INCLUDES_URL . 'front-assets/css/hs-slider.css');
});

add_action('wp_enqueue_scripts', function () {
    if (is_page('panel') || is_page('purchase')) {
        ncp_dequeue_scripts();
    }
    if (is_page('login-register')) {
        ncp_dequeue_scripts();
    }
    if (is_page('test-2')) {
        wp_dequeue_style('elementor-icons');
        wp_dequeue_style('elementor-common');
        wp_dequeue_style('e-theme-ui-light');
        wp_dequeue_style('revslider-material-icons');
        wp_dequeue_style('nitro-main');
        wp_dequeue_style('elementor-post-22');
        wp_dequeue_style('table');
        wp_dequeue_script('table');

    }
}, 10000);
//upload file setup
add_filter('upload_dir', 'custom_upload_dir');

//shortcodes
add_shortcode('nitro_blog', 'display_main_page_blog_slider');
add_shortcode('nitro_slider', 'nitro_slider');
add_shortcode('my_account_template', 'my_account_template_function');
add_shortcode('login_template', 'login_template_function');
add_shortcode('ncp_payment_callback', 'ncp_payment_callback');
add_shortcode('ncp_login_btn', 'ncp_login_btn');
add_shortcode('rules_template', function () {
    include_once NCP_PLUGIN_RULES . 'rules-template.php';
});

add_action('admin_post_custom_login_action', 'send_login_data_to_api');

//template loader with ajax
add_action('wp_ajax_ncp_withdrawal_loader', 'ncp_withdrawal_loader');
add_action('wp_ajax_nopriv_ncp_withdrawal_loader', 'ncp_withdrawal_loader');

add_action('wp_ajax_ncp_exit', 'ncp_exit');
add_action('wp_ajax_nopriv_ncp_exit', 'ncp_exit');

add_action('wp_ajax_ncp_dashboard_loader', 'ncp_dashboard_loader');
add_action('wp_ajax_nopriv_ncp_dashboard_loader', 'ncp_dashboard_loader');

add_action('wp_ajax_ncp_challenge_loader', 'ncp_challenge_loader');
add_action('wp_ajax_nopriv_ncp_challenge_loader', 'ncp_challenge_loader');

add_action('wp_ajax_ncp_requests_loader', 'ncp_requests_loader');
add_action('wp_ajax_nopriv_ncp_requests_loader', 'ncp_requests_loader');

add_action('wp_ajax_ncp_authentication_loader', 'ncp_authentication_loader');
add_action('wp_ajax_nopriv_ncp_authentication_loader', 'ncp_authentication_loader');

add_action('wp_ajax_ncp_profile_loader', 'ncp_profile_loader');
add_action('wp_ajax_nopriv_ncp_profile_loader', 'ncp_profile_loader');

add_action('wp_ajax_ncp_register_loader', 'ncp_register_loader');
add_action('wp_ajax_nopriv_ncp_register_loader', 'ncp_register_loader');

add_action('wp_ajax_ncp_login_loader', 'ncp_login_loader');
add_action('wp_ajax_nopriv_ncp_login_loader', 'ncp_login_loader');

add_action('wp_ajax_ncp_forget_pass_loader', 'ncp_forget_pass_loader');
add_action('wp_ajax_nopriv_ncp_forget_pass_loader', 'ncp_forget_pass_loader');

add_action('wp_ajax_ncp_support_loader', 'ncp_support_loader');
add_action('wp_ajax_nopriv_ncp_support_loader', 'ncp_support_loader');

add_action('wp_ajax_ncp_login', 'ncp_login');
add_action('wp_ajax_nopriv_ncp_login', 'ncp_login');

add_action('wp_ajax_ncp_register', 'ncp_register');
add_action('wp_ajax_nopriv_ncp_register', 'ncp_register');

add_action('wp_ajax_ncp_forget_pass', 'ncp_forget_pass');
add_action('wp_ajax_nopriv_ncp_forget_pass', 'ncp_forget_pass');

add_action('wp_ajax_upload_authentication_form', 'upload_authentication_form');
add_action('wp_ajax_nopriv_upload_authentication_form', 'upload_authentication_form');

add_action('wp_ajax_ncp_pass_changer', 'ncp_pass_changer');
add_action('wp_ajax_nopriv_ncp_pass_changer', 'ncp_pass_changer');

add_action('wp_ajax_ncp_request_send', 'ncp_request_send');
add_action('wp_ajax_nopriv_ncp_request_send', 'ncp_request_send');

add_action('wp_ajax_ncp_request_list', 'ncp_request_list');
add_action('wp_ajax_nopriv_ncp_request_list', 'ncp_request_list');

//payment ajax hooks
add_action('wp_ajax_ncp_challenges_buy', 'ncp_challenges_buy');
add_action('wp_ajax_nopriv_ncp_challenges_buy', 'ncp_challenges_buy');

add_action('wp_ajax_ncp_discount_check', 'ncp_discount_check');
add_action('wp_ajax_nopriv_ncp_discount_check', 'ncp_discount_check');

add_action('wp_ajax_ncp_state_loader', 'ncp_state_loader');
add_action('wp_ajax_nopriv_ncp_state_loader', 'ncp_state_loader');

add_action('wp_ajax_ncp_withdrawal_request', 'ncp_withdrawal_request');
add_action('wp_ajax_nopriv_ncp_withdrawal_request', 'ncp_withdrawal_request');

add_action('after_setup_theme', 'remove_admin_bar_for_non_admins');
function remove_admin_bar_for_non_admins()
{
    if (!current_user_can('administrator')) {
        show_admin_bar(false);
    }
}

add_action('admin_init', 'restrict_wp_admin_access');
function restrict_wp_admin_access()
{
    if (!current_user_can('administrator') && !wp_doing_ajax()) {
        wp_redirect(home_url());
        exit;
    }
}


include_once NCP_PLUGIN_TEMPLATES . 'my-account/withdrawal.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/challenge.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/dashboard.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/requests.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/profile.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/authentication.php';
include_once NCP_PLUGIN_TEMPLATES . 'my-account/support.php';
include_once NCP_PLUGIN_TEMPLATES . 'login/register.php';
include_once NCP_PLUGIN_TEMPLATES . 'login/login.php';
include_once NCP_PLUGIN_TEMPLATES . 'login/forget-pass.php';
require NCP_PLUGIN_INCLUDES . 'front-assets/classes/jdatetime.class.php';

///////admin hooks///////

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('nitro-admin', NCP_PLUGIN_INCLUDES_URL . 'admin-assets/js/nitro-admin.js', ['jquery'], null, true);
    wp_enqueue_style('nitro-admin', NCP_PLUGIN_INCLUDES_URL . 'admin-assets/css/nitro-admin.css');
    wp_localize_script('nitro-admin', 'ajax_filter_params', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'siteUrl' => home_url(),
        'nonce' => wp_create_nonce('my_ajax_nonce'),
    ]);
});
//add admin menu
add_action('admin_menu', 'nitro_prop_menu');

add_action('wp_ajax_update_auth_status', 'update_auth_status_callback');
add_action('wp_ajax_delete_nitro_row_callback', 'delete_nitro_row_callback');

function ncp_dequeue_scripts()
{
    wp_dequeue_style('wp-block-library-rtl');
    wp_deregister_style('wp-block-library-rtl');
    wp_dequeue_style('alsp-font');
    wp_deregister_style('alsp-font');
    wp_dequeue_style('revslider-material-icons');
    wp_deregister_style('revslider-material-icons');
    wp_dequeue_style('revslider-basics-css');
    wp_deregister_style('revslider-basics-css');
    wp_dequeue_style('rs-color-picker-css');
    wp_deregister_style('rs-color-picker-css');
    wp_dequeue_style('revbuilder-ddTP');
    wp_deregister_style('revbuilder-ddTP');
    wp_dequeue_style('rs-roboto');
    wp_deregister_style('rs-roboto');
    wp_dequeue_style('contact-form-7');
    wp_deregister_style('contact-form-7');
    wp_dequeue_style('contact-form-7-rtl');
    wp_deregister_style('contact-form-7-rtl');
    wp_dequeue_style('swiper');
    wp_deregister_style('swiper');
    wp_dequeue_style('hello-elementor-theme-style');
//    wp_dequeue_style( 'hello-elementor' );
    wp_dequeue_style('hello-elementor-header-footer');
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_style('elementor-frontend');
    wp_dequeue_style('elementor-post-22');
    wp_dequeue_style('elementor-pro');
    wp_dequeue_style('elementor-global');


    wp_dequeue_script('underscore');
    wp_deregister_script('underscore');
    wp_dequeue_script('swv');
    wp_deregister_script('swv');
    wp_dequeue_script('tp-tools');
    wp_deregister_script('tp-tools');
    wp_dequeue_script('revmin');
    wp_deregister_script('revmin');
    wp_dequeue_script('hello-theme-frontend');
    wp_deregister_script('hello-theme-frontend');
    add_action('wp_default_scripts', function ($scripts) {
        $scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, array('jquery-migrate'));
    });
}


add_shortcode('table_section', 'table_section_shortcode');
