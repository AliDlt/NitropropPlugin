<?php
defined('ABSPATH') or die('Access Denied!');

//helper functions
function add_meta_tag()
{
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">';
}

function display_main_page_blog_slider()
{
    $args = array(
        'posts_per_page' => 3,
        'orderby' => 'date',
        'order' => 'DESC',
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ?>
        <div class="nitro-posts-sec swiper mySwiper">
            <div class="swiper-wrapper">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    ?>
                    <div class="nitro-post swiper-slide">
                        <a href="<?php the_permalink(); ?>" class="nitro-post-img">
                            <?php the_post_thumbnail(); ?>
                            <h2 class="nitro-post-title"><?php the_title(); ?></h2>
                        </a>
                        <div class="nitro-post-content">
                            <?php the_content(); ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="nitro-post-more">مشاهده بیشتر</a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        <?php
        wp_reset_postdata();
    } else {
        echo 'هیچ نوشته‌ای یافت نشد';
    }
}

function state_svg($state)
{
    $stateHTML = [];
    if ($state == 'trading') {
        $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(31, 214, 137, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(31, 214, 137, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(31, 214, 137, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(31, 214, 137, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite" />
                </circle>
            </svg>';
    } elseif ($state == 'rejected') {
        $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(247, 58, 124, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(247, 58, 124, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(247, 58, 124, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(247, 58, 124, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
            </svg>';
    } elseif ($state == 'completed') {
        $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(83, 134, 228, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(83, 134, 228, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(83, 134, 228, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(83, 134, 228, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite" />
                </circle>
            </svg>';
    }
    return $stateHTML;
}

function log_out_ncp()
{
    ?>
    <script>
        window.location.href = "<?php echo site_url('/login-register'); ?>";
    </script>
    <?php

}

function logout_and_delete_cookie()
{
    if (isset($_COOKIE['ncp_access_token'])) {
        unset($_COOKIE['ncp_access_token']);
        setcookie('ncp_access_token', '', time() - 3600, '/');
    }
    wp_logout();
    wp_redirect(home_url());
}

function _custom_check_national_code($code)
{
//    if (!preg_match('/^[0-9]{10}$/', $code))
//        return false;
//    for ($i = 0; $i < 10; $i++)
//        if (preg_match('/^' . $i . '{10}$/', $code))
//            return false;
//    for ($i = 0, $sum = 0; $i < 9; $i++)
//        $sum += ((10 - $i) * intval(substr($code, $i, 1)));
//    $ret = $sum % 11;
//    $parity = intval(substr($code, 9, 1));
//    if (($ret < 2 && $ret == $parity) || ($ret >= 2 && $ret == 11 - $parity))
//        return true;
//    return false;
    if (is_numeric($code) && strlen($code) === 10 && preg_match('/^\d{10}$/', $code)) {
        return true;
    }
    return false;
}

function custom_upload_dir($dir)
{
    $custom_dir = '/nitro';
    $dir['subdir'] = $custom_dir;
    $dir['path'] = $dir['basedir'] . $dir['subdir'];
    $dir['url'] = $dir['baseurl'] . $dir['subdir'];

    if (!file_exists($dir['path'])) {
        mkdir($dir['path'], 0755, true);
    }

    return $dir;
}

function ncp_pass_changer()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $newPass = isset($_POST['newPass']) ? sanitize_text_field($_POST['newPass']) : '';
    $oldPass = isset($_POST['oldPass']) ? sanitize_text_field($_POST['oldPass']) : '';
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    wp_send_json(api_change_password($nitro_access_token, $oldPass, $newPass));
}


//login ajax and page loader
function login_template_function()
{

    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_info_response['status'] == 200) {
        ?>
        <script>
            window.location.href = "<?php echo site_url('/panel'); ?>";
        </script>
        <?php
        die();
    } else {
        include_once NCP_PLUGIN_TEMPLATES . 'login/custom-login.php';
    }
}

function ncp_login_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    if ($nitro_access_token) {
        $account_info_response = api_account_info($nitro_access_token);
        if ($account_info_response['status'] == 200) {
            ?>
            <script>
                window.location.href = "<?php echo site_url('/panel'); ?>";
            </script>
            <?php
        } else {
            wp_send_json(login_template());
        }
    } else {
        wp_send_json(login_template());
    }


}

function ncp_register_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    wp_send_json(register_template());
}

function ncp_forget_pass_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    wp_send_json(forget_pass_template());
}

//function ncp_login()
//{
//
//    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
//    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
//    if ($email && $password) {
//        if (isset($_COOKIE['nitro_access_token'])) {
//            unset($_COOKIE['nitro_access_token']);
//            setcookie('nitro_access_token', '', time() - 3600, '/');
//        }
//        $response = login_api($email, $password);
//        if (!$response['status']) {
//            $nitro_access_token = $response['access'];
//            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
//            setcookie("nitro_access_token", $nitro_access_token, 0, '/', $domain);
//            $user = get_user_by('email', $email);
//            if ($user) {
//                $creds = [
//                    'user_login' => $user->user_login,
//                    'user_password' => $password,
//                    'remember' => true
//                ];
//                if (wp_check_password($password, $user->user_pass, $user->ID)) {
//                    $wp_user = wp_signon($creds, false);
//                    if (is_wp_error($wp_user)) {
//                        wp_send_json_error($wp_user->get_error_message());
//                    } else {
//                        wp_send_json_success([
//                            'message' => 'Logged in successfully',
//                            'user' => $wp_user
//                        ]);
//                    }
//                } else {
//                    wp_set_password($password, $user->ID);
//                    $wp_user = wp_signon($creds, false);
//                    if (is_wp_error($wp_user)) {
//                        wp_send_json_error($wp_user->get_error_message());
//                    } else {
//                        wp_send_json_success([
//                            'message' => 'Password updated and logged in successfully',
//                            'user' => $wp_user
//                        ]);
//                    }
//                }
//            } else {
//                $user_id = wp_create_user($email, $password, $email);
//                if (is_wp_error($user_id)) {
//                    wp_send_json_error($user_id->get_error_message());
//                } else {
//                    $user = get_user_by('id', $user_id);
//                    wp_set_current_user($user_id);
//                    wp_set_auth_cookie($user_id);
//                    wp_send_json_success([
//                        'message' => 'User created and logged in successfully',
//                        'user' => $user
//                    ]);
//                }
//            }
//        } else {
//            wp_send_json_error($response);
//        }
//        die();
//    } else {
//        echo "access denied";
//        die();
//    }
//}

function ncp_login()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');

    if (!isset($_POST['recaptcha_token'])) {
        wp_send_json_error(array('message' => 'توکن reCAPTCHA وجود ندارد'));
    }

    $recaptcha_token = sanitize_text_field($_POST['recaptcha_token']);
    $secret_key = '6LdzJvEpAAAAAMc71JHqEamb9bDVp7cuqFSWrFwm';

    $response = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", array(
        'body' => array(
            'secret' => $secret_key,
            'response' => $recaptcha_token
        )
    ));

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => 'ارتباط با سرور reCAPTCHA ناموفق بود.', 'error' => $response->get_error_message()));
    }

    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);

    if (!$result['success']) {
        wp_send_json_error(array('message' => 'تأیید reCAPTCHA ناموفق بود.', 'error-codes' => $result['error-codes']));
    }

    $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';

    if ($email && $password) {
        if (isset($_COOKIE['nitro_access_token'])) {
            unset($_COOKIE['nitro_access_token']);
            setcookie('nitro_access_token', '', time() - 3600, '/');
        }

        $response = login_api($email, $password);
        if (!$response['status']) {
            $nitro_access_token = $response['access'];
            $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
            setcookie("nitro_access_token", $nitro_access_token, 0, '/', $domain);

            $user = get_user_by('email', $email);
            if ($user) {
                $creds = [
                    'user_login' => $user->user_login,
                    'user_password' => $password,
                    'remember' => true
                ];

                if (wp_check_password($password, $user->user_pass, $user->ID)) {
                    $wp_user = wp_signon($creds, false);
                    if (is_wp_error($wp_user)) {
                        wp_send_json_error($wp_user->get_error_message());
                    } else {
                        wp_send_json_success([
                            'message' => 'خوش آمدید',
                            'user' => $wp_user
                        ]);
                    }
                } else {
                    wp_set_password($password, $user->ID);
                    $wp_user = wp_signon($creds, false);
                    if (is_wp_error($wp_user)) {
                        wp_send_json_error($wp_user->get_error_message());
                    } else {
                        wp_send_json_success([
                            'message' => 'خوش آمدید',
                            'user' => $wp_user
                        ]);
                    }
                }
            } else {
                $user_id = wp_create_user($email, $password, $email);
                if (is_wp_error($user_id)) {
                    wp_send_json_error($user_id->get_error_message());
                } else {
                    $user = get_user_by('id', $user_id);
                    wp_set_current_user($user_id);
                    wp_set_auth_cookie($user_id);
                    wp_send_json_success([
                        'message' => 'خوش آمدید',
                        'user' => $user
                    ]);
                }
            }
        } else {
            wp_send_json_error($response);
        }
        die();
    } else {
        echo "access denied";
        die();
    }
}


//panel ajax and page loader
function my_account_template_function()
{
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_info_response['status'] == 200) {
        include_once NCP_PLUGIN_TEMPLATES . 'my-account/main.php';
    } else {
        log_out_ncp();
        die();
    }
}

function ncp_withdrawal_loader()
{
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
//    $account_info_response = api_account_info($nitro_access_token);
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $account_file_response = api_account_file($nitro_access_token);
    if ($dataId !== null) {
        if ($nitro_access_token && $account_file_response['status'] == 200) {

            wp_send_json(withdrawal_loader($dataId,$account_file_response, $nitro_access_token));
        } else {
            log_out_ncp();
            die();
        }
    } else {
        wp_send_json_error('access denied');
    }
}


function ncp_challenge_loader()
{
//    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
//    $account_info_response = api_account_info($nitro_access_token);
//    if ($nitro_access_token && $account_info_response['status'] == 200) {
//        wp_send_json(challenge_page($account_info_response, $nitro_access_token));
//    } else {
//        log_out_ncp();
//        die();
//    }

    check_ajax_referer('my_ajax_nonce', 'nonce');
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
//    $account_info_response = api_account_info($nitro_access_token);
    $challenge_prices_response = api_get_challenge_prices($nitro_access_token);
    if ($challenge_prices_response['status'] == 200) {
        wp_send_json(challenge_page($challenge_prices_response, $nitro_access_token));
    } else {
        log_out_ncp();
        die();
    }
}

function ncp_dashboard_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $refresh_dashboard = isset($_POST['refresh_dashboard']) ? sanitize_text_field($_POST['refresh_dashboard']) : '';
    $statusLoader = isset($_POST['$statusLoader']) ? sanitize_text_field($_POST['$statusLoader']) : '';
    if ($dataId !== null) {
        $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
        if ($refresh_dashboard){
            api_account_sync($nitro_access_token,$dataId);
        }
        $account_info_response = api_account_info($nitro_access_token);
        $account_file_response = api_account_file($nitro_access_token);
//        $data = $account_file_response['data'][$dataArrayId];
        $data = [];
        foreach ($account_file_response['data'] as $item) {
            if ($item['id'] == $dataId) {
                $data = $item;
                break;
            }
        }
        $state = $data["state"];
        $stateHTML = state_svg($state);
        $cookie_name = "ncp_is_page";
        $cookie_value = "dashboard";
        $cookie_expiry = time() + 3600;
        setcookie($cookie_name, $cookie_value, $cookie_expiry, "/");
        if ($state == 'trading') {
            $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(31, 214, 137, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(31, 214, 137, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(31, 214, 137, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(31, 214, 137, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite" />
                </circle>
            </svg>';
        } elseif ($state == 'rejected') {
            $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(247, 58, 124, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(247, 58, 124, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(247, 58, 124, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(247, 58, 124, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
            </svg>';
        } elseif ($state == 'completed') {
            $stateHTML = '<svg width="50" height="50" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter x="-50%" y="-50%" width="50%" height="50%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="5"></feGaussianBlur>
                        <feOffset dx="3" dy="3" result="offsetblur"></feOffset>
                        <feMerge>
                            <feMergeNode></feMergeNode>
                            <feMergeNode in="SourceGraphic"></feMergeNode>
                        </feMerge>
                    </filter>
                </defs>
                <circle cx="100" cy="100" r="40" fill="rgba(83, 134, 228, 1)" filter=""></circle>
                <circle cx="100" cy="100" r="60" fill="none" stroke="rgba(83, 134, 228, 0.5)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="75" fill="none" stroke="rgba(83, 134, 228, 0.2)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite"></animate>
                </circle>
                <circle cx="100" cy="100" r="90" fill="none" stroke="rgba(83, 134, 228, 0.1)" stroke-width="4">
                    <animate attributeName="opacity" values="1;0;1" dur="2s" repeatCount="indefinite" />
                </circle>
            </svg>';
        }
        $selectHTML = '';

        if ($account_file_response['data']){
            $selectHTML .= '<select class="btn-account-code appearance-none" name="status_id " id="status_id">';
            $first_array = 0;
            foreach ($account_file_response['data'] as $dataSellect) {
                $selectHTML .= '<option value="' . $dataSellect['login'] . '"';
                $selectHTML .= $data['login'] == $dataSellect['login'] ? 'selected="selected "':'';
                $selectHTML .= 'data-array-id="'. $first_array.'"data-id="'. $dataSellect['id'].'">';
                $selectHTML .= $dataSellect['login'];
                $selectHTML .= '</option>';
                $first_array++;
            }
            $selectHTML .= '</select>';
        }else{
            $selectHTML .= '<div class="btn-account-code appearance-none">-</div>';
        }
        if ($nitro_access_token && $account_info_response['status'] == 200) {
            wp_send_json([
                "template" => dashboard_template($account_info_response, $data),
                "step" => $stateHTML,
                "select" => $selectHTML,
            ]);
        } else {
            log_out_ncp();
            die();
        }
    } else {
        wp_send_json_error('access denied');
    }
}


function ncp_state_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';

    if ($dataId !== null) {
        $account_file_response = api_account_file($nitro_access_token);
        $data = [];
//    $data = $account_file_response['data'][$dataArrayId];
        foreach ($account_file_response['data'] as $item) {
            if ($item['id'] == $dataId) {
                $data = $item;
                break;
            }
        }
        $state = $data["state"];
        $stateHTML = state_svg($state);
        wp_send_json([
            "step" => $stateHTML
        ]);
    } else {
        wp_send_json_error('access denied');
    }
}

function ncp_requests_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $dataArrayVal = isset($_POST['dataArrayVal']) ? sanitize_text_field($_POST['dataArrayVal']) : '';
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_file_response = api_account_file($nitro_access_token);
//    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_file_response['status'] == 200) {
//        $acc_id = $account_file_response['data'][$dataArrayId]['id'];
        wp_send_json(requests_template($dataId, $account_file_response));
    } else {
        log_out_ncp();
        die();
    }
}
//function ncp_requests_loader()
//{
//    check_ajax_referer('my_ajax_nonce', 'nonce');
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
//    $dataArrayVal = isset($_POST['dataArrayVal']) ? sanitize_text_field($_POST['dataArrayVal']) : '';
//    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
//    $account_info_response = api_account_info($nitro_access_token);
//    if ($nitro_access_token && $account_info_response['status'] == 200) {
//        $account_file_response = api_account_file($nitro_access_token);
//        $acc_id = $account_file_response['data'][$dataArrayId]['id'];
//        wp_send_json(requests_template($acc_id, $dataArrayVal));
//    } else {
//        log_out_ncp();
//        die();
//    }
//}

function ncp_profile_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_info_response['status'] == 200) {
        wp_send_json(profile_template($account_info_response));
    } else {
        log_out_ncp();
        die();

    }
}

function ncp_support_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_info_response['status'] == 200) {
        wp_send_json(support_template($account_info_response));
    } else {
        log_out_ncp();
        die();

    }
}

function ncp_exit()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $domain = $_SERVER['HTTP_HOST'];
    if ($domain == 'localhost' || $domain == '127.0.0.1' || preg_match('/^192\.168\.\d+\.\d+$/', $domain)) {
        $domain = false;
    }
    setcookie('nitro_access_token', '', time() - 3600, '/', $domain);
    wp_logout();
    wp_send_json('done');
}

function ncp_authentication_loader()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $account_info_response = api_account_info($nitro_access_token);
    if ($nitro_access_token && $account_info_response['status'] == 200) {
        wp_send_json(authentication_loader($account_info_response));
    } else {
        log_out_ncp();
        die();
    }
}

function upload_authentication_form()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');

    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $account_id = intval($_POST['account_id']);
    $codeMeli = sanitize_text_field($_POST['code_melli']);
    if (!_custom_check_national_code($codeMeli)) {
        wp_send_json_error(['message' => 'کد ملی شما معتبر نیست']);
    }
    $existing_account = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE account_id = %d", $account_id));
    if ($existing_account > 0) {
        wp_send_json_error(['message' => 'شما قبلا اطلاعات خود را ارسال کرده اید']);
    }
    $file_urls = [];
    if (!empty($_FILES)) {
        foreach ($_FILES as $file_key => $file) {
            if (!empty($file['name'])) {
                $uploadedfile = $file;
                $upload_overrides = ['test_form' => false];
                add_filter('upload_dir', 'custom_upload_dir');
                $movefile = wp_handle_upload($uploadedfile, $upload_overrides);
                remove_filter('upload_dir', 'custom_upload_dir');
                if ($movefile && !isset($movefile['error'])) {
                    $file_urls[$file_key] = $movefile['url'];
                } else {
                    wp_send_json_error(['message' => $movefile['error']]);
                }
            }
        }
    } else {
        wp_send_json_error(['message' => 'لطفاً فایل‌هامورد نظر را آپلود کنید']);
    }
    $data = [
        'birth_date' => sanitize_text_field($_POST['birth_date']),
        'code_melli' => $codeMeli,
        'full_name' => sanitize_text_field($_POST['full_name']),
        'cart_melli_url' => $file_urls['cart_melli_upload'],
        'selfie_url' => $file_urls['selfie_upload'],
        'account_id' => $account_id,
        'auth_status' => 1
    ];
    $wpdb->insert($table_name, $data);
    wp_send_json_success(['message' => 'اطلاعات با موفقیت ارسال شد']);
}

function ncp_login_btn()
{
    if (is_user_logged_in()) {
        ?>
        <div class="login_btn_wrapper">
            <a href="/panel">
                <img class="btn-login-person" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/profilelogin.svg'?>"
                     alt="iconProfile">
            </a>
            <div class="btn-account-name login_btn">
                حساب کاربری
                <div class="dropdown-menu">
                    <a href="/panel/">داشبورد</a>
                    <a href="/panel/?land=challenge">خرید چالش</a>
                    <a href="/panel/?land=request">ثبت درخواست</a>
                    <a href="/panel/?land=withdrawal">برداشت سود</a>
                    <a href="/panel/?land=authentication">احراز هویت</a>
                    <a href="/panel/?land=profile">حساب کاربری</a>
                    <a href="/support/">پشتیبانی</a>
                    <a class="npc-exit-profile">خروج</a>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <a href="/login-register" class="login_register_btn">
            <p>ورود/عضویت</p>
            <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/profilelogin.svg' ?>" alt="">
        </a>
        <?php
    }
}


//api requests
function login_api($email, $password)
{
    $body = [
        'email' => $email,
        'password' => $password,
    ];
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://client.nitroprop.net/api/auth/login/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json'
        ],
    ]);
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function ncp_register()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    if (!isset($_POST['recaptcha_token'])) {
        wp_send_json(array('message' => 'توکن reCAPTCHA وجود ندارد'));
    }

    $recaptcha_token = sanitize_text_field($_POST['recaptcha_token']);
    $secret_key = '6LdzJvEpAAAAAMc71JHqEamb9bDVp7cuqFSWrFwm';

    $response = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", array(
        'body' => array(
            'secret' => $secret_key,
            'response' => $recaptcha_token
        )
    ));

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => 'ارتباط با سرور reCAPTCHA ناموفق بود.', 'error' => $response->get_error_message()));
    }

    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);

    if (!$result['success']) {
        wp_send_json_error(array('message' => 'تأیید reCAPTCHA ناموفق بود.', 'error-codes' => $result['error-codes']));
    }
    $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
    $password = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
    $repeatPassword = isset($_POST['repeatPassword']) ? sanitize_text_field($_POST['repeatPassword']) : '';
    $fullname = isset($_POST['fullname']) ? sanitize_text_field($_POST['fullname']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $latinName = isset($_POST['latinName']) ? sanitize_text_field($_POST['latinName']) : '';
    $latinlastName = isset($_POST['latinlastName']) ? sanitize_text_field($_POST['latinlastName']) : '';
    $body = [
        'email' => $email,
        'password' => $password,
        'password2' => $repeatPassword,
        'fullname' => $fullname,
        'phone_number' => $phone,
        'first_name_en' => $latinName,
        'last_name_en' => $latinlastName,
    ];
    $body_json = json_encode($body);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/register/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body_json,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $decoded_response = json_decode($response, true);
    wp_send_json($decoded_response);
}

function ncp_forget_pass()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    if (!isset($_POST['recaptcha_token'])) {
        wp_send_json_error(array('message' => 'توکن reCAPTCHA وجود ندارد'));
    }

    $recaptcha_token = sanitize_text_field($_POST['recaptcha_token']);
    $secret_key = '6LdzJvEpAAAAAMc71JHqEamb9bDVp7cuqFSWrFwm';

    $response = wp_remote_post("https://www.google.com/recaptcha/api/siteverify", array(
        'body' => array(
            'secret' => $secret_key,
            'response' => $recaptcha_token
        )
    ));

    if (is_wp_error($response)) {
        wp_send_json_error(array('message' => 'ارتباط با سرور reCAPTCHA ناموفق بود.', 'error' => $response->get_error_message()));
    }

    $response_body = wp_remote_retrieve_body($response);
    $result = json_decode($response_body, true);

    if (!$result['success']) {
        wp_send_json_error(array('message' => 'تأیید reCAPTCHA ناموفق بود.', 'error-codes' => $result['error-codes']));
    }
    $email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
    $curl = curl_init();
    $body = [
        'email' => $email,
    ];
    $body_json = json_encode($body);
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/forget-password/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $body_json,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $decoded_response = json_decode($response, true);
    wp_send_json($decoded_response);

}

function api_account_info($nitro_access_token)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/list/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $nitro_access_token,
        ),
    ));

    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function api_account_file($nitro_access_token)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/accounts/list/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $nitro_access_token],
    ]);

    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function api_get_challenge_prices($nitro_access_token)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://client.nitroprop.net/api/prices/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $nitro_access_token],
    ]);
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function api_account_sync($nitro_access_token,$id)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/core/account/'.$id.'/syncAccount/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$nitro_access_token,
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
}
function api_challenges_buy($nitro_access_token, $platform, $groupID, $discountCode)
{

    $curl = curl_init();
    if ($platform == 'jibit') {
        $body = [
            'group' => $groupID,
            'platform' => $platform,
        ];
        if ($discountCode) {
            $body = array_merge($body, ['discount_code' => $discountCode]);
        }
    } else {
        $body = [
            'group' => $groupID,
            'platform' => $platform,
            'pay_currency' => 'USDTTRC20',
            'price_currency' => 'USDTTRC20'
        ];
        if ($discountCode) {
            $body = array_merge($body, ['discount_code' => $discountCode]);
        }
    }
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://client.nitroprop.net/api/challenges/buy/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $nitro_access_token
        ],
    ]);

    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function api_discount_checker($nitro_access_token, $code, $groupID)
{


    $curl = curl_init();
    $body = [
        'group' => $groupID,
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/discount/' . $code . '/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $nitro_access_token],
    ));

    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;

}

function api_withdrawal_request($code, $nitro_access_token, $dataId ,$dataArrayVal)
{
    $curl = curl_init();
    $body = [
        'address' => $code,
        'login'=>$dataArrayVal
    ];
    curl_setopt_array($curl, [
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/accounts/' . $dataId . '/withdraws/create/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $nitro_access_token,
        ],
    ]);
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;

}

function api_withdrawal_history($nitro_access_token, $id)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/accounts/' . $id . '/withdraws/list/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $nitro_access_token
        ),
    ));

    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;

}

function api_change_password($nitro_access_token, $oldPass, $newPass)
{
    $curl = curl_init();
    $body = [
        'password' => $oldPass,
        'new_password' => $newPass,
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/password/update/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'PUT',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $nitro_access_token
        ),
    ));
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}

function send_login_data_to_api()
{
    if (isset($_POST['action']) && $_POST['action'] === 'custom_login_action') {
        // API endpoint
        $url = 'https://client.nitroprop.net/api/auth/login/';
        // Data to be sent
        $data = array(
            'email' => $_POST['email'],
            'password' => $_POST['password']
        );
        // Send POST request
        $response = wp_remote_post(
            $url,
            array(
                'body' => json_encode($data),
                'headers' => array(
                    'Content-Type' => 'application/json',
                ),
                'method' => 'POST',
                'data_format' => 'body',
            )
        );
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
            echo "Something went wrong: $error_message";
        } else {
            $response_body = wp_remote_retrieve_body($response);
            echo $response_body;
        }
        die();
    }
}

function api_send_request($request_type, $description, $acc_id, $nitro_access_token)
{
    $curl = curl_init();
    $body = [
        'title' => $request_type,
        'description' => $description
    ];
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/accounts/' . $acc_id . '/requests/create/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($body),
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $nitro_access_token,
        ),
    ));
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;

}

function api_list_request($acc_id)
{
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://client.nitroprop.net/api/users/accounts/' . $acc_id . '/requests/list/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $nitro_access_token,
        ),
    ));
    $response = curl_exec($curl);
    $decoded_response = json_decode($response, true);
    curl_close($curl);
    return $decoded_response;
}


//payment functions
function ncp_challenges_buy()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $groupID = isset($_POST['groupID']) ? sanitize_text_field($_POST['groupID']) : '';
    $paymentMethod = isset($_POST['paymentMethod']) ? sanitize_text_field($_POST['paymentMethod']) : '';
    $discountCode = isset($_POST['discountCode']) ? sanitize_text_field($_POST['discountCode']) : '';
    if ($paymentMethod === 'digital') {
        $platform = 'nowpayment';
    } else {
        $platform = 'jibit';
    }
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $response = api_challenges_buy($nitro_access_token, $platform, $groupID, $discountCode);
    wp_send_json($response);
//    if ($response['status'] === 200) {
//        wp_send_json($response);
//    } else {
//        wp_send_json_error('پرداخت انجام نشد');
//    }
}

function ncp_discount_check()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $code = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
    $groupID = isset($_POST['groupID']) ? sanitize_text_field($_POST['groupID']) : '';
    $response = api_discount_checker($nitro_access_token, $code, $groupID);
    $response['ir_price_formatted'] = number_format($response['ir_price'], 0, '.', ',');
    wp_send_json($response);
}

function ncp_payment_callback()
{
    include_once NCP_PLUGIN_TEMPLATES . 'my-account/payment-page.php';

}


//withdrawal request
function ncp_withdrawal_request()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $code = isset($_POST['code']) ? sanitize_text_field($_POST['code']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $dataArrayVal = isset($_POST['dataArrayVal']) ? sanitize_text_field($_POST['dataArrayVal']) : '';
//    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';

    if ($code && $dataId) {
//        $response = api_account_file($nitro_access_token);
//        $dataArray = $response['data'][$dataArrayId];
        $dataArray = [];
//        foreach ($response['data'] as $item) {
//            if ($item['id'] == $dataId) {
//                $dataArray = $item;
//                break;
//            }
//        }
//        $current_balance = $dataArray ? $dataArray['current_balance'] : 0;
//        $percentage_value = $current_balance * 0.8;
//        $rounded_value = round($percentage_value);
        $response = api_withdrawal_request($code, $nitro_access_token, $dataId,$dataArrayVal);
        if ($response){
            wp_send_json($response);
        }else{
            wp_send_json_error();
        }
    }
}


//request
function ncp_request_send()
{
    check_ajax_referer('my_ajax_nonce', 'nonce');
    $request_type = isset($_POST['request_type']) ? sanitize_text_field($_POST['request_type']) : '';
    $description = isset($_POST['description']) ? sanitize_text_field($_POST['description']) : '';
    $dataArrayId = isset($_POST['dataArrayId']) ? sanitize_text_field($_POST['dataArrayId']) : '';
    $dataId = isset($_POST['dataId']) ? sanitize_text_field($_POST['dataId']) : '';
    $dataArrayVal = isset($_POST['dataArrayVal']) ? sanitize_text_field($_POST['dataArrayVal']) : '';
    if ($dataId !== 'undefined') {
        $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';

        $response = api_send_request($request_type, $description, $dataId, $nitro_access_token);

        wp_send_json([
            'res' => $response,
        ]);
    } else {
        wp_send_json(['code' => 401]);
    }

}


//admin functions
function nitro_prop_menu()
{
    $icon_url = NCP_PLUGIN_INCLUDES_URL . 'admin-assets/img/blogicon.svg';
    add_menu_page(
        'نیترو پراپ',
        'نیترو پراپ',
        'manage_options',
        'nitro-prop',
        'nitro_prop_page',
        $icon_url,
        2
    );
}

function nitro_prop_page()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline">احراز هویت</h1>
        <table class="wp-list-table widefat fixed striped table-view-list nitro-list-table">
            <thead>
            <tr>
                <th scope="col" class="manage-column">شماره کاربری</th>
                <th scope="col" class="manage-column">نام و نام خانوادگی</th>
                <th scope="col" class="manage-column">تاریخ تولد</th>
                <th scope="col" class="manage-column">کد ملی</th>
                <th scope="col" class="manage-column">عکس کارت ملی</th>
                <th scope="col" class="manage-column">عکس سلفی</th>
                <th scope="col" class="manage-column">وضعیت</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($results)) {
                foreach ($results as $row) {
                    ?>
                    <tr>
                        <td><?php echo $row['account_id'] ?></td>
                        <td><?php echo $row['full_name'] ?></td>
                        <td><?php echo $row['birth_date'] ?></td>
                        <td><?php echo $row['code_melli'] ?></td>
                        <td><a href="<?php echo $row['cart_melli_url'] ?>" target="_blank">مشاهده</a></td>
                        <td><a href="<?php echo $row['selfie_url'] ?>" target="_blank">مشاهده</a></td>
                        <td> <?php
                            switch ($row['auth_status']) {
                                case (0):
                                    echo 'انجام نشده';
                                    break;
                                case (1):
                                    echo 'در انتظار تایید';
                                    break;
                                case (2):
                                    echo 'تایید شده';
                                    break;
                                case (3):
                                    echo 'رد شده';
                                    break;
                            }
                            ?> </td>
                        <td>
                            <button type="button" id="auth_status_reject" data-id="<?php echo $row['id'] ?>"
                                    class="button-secondary small danger">رد
                            </button>
                            <button type="button" id="auth_status_accept" data-id="<?php echo $row['id'] ?>"
                                    class="button-secondary small ">
                                تایید
                            </button>
                            <button type="button" id="auth_delete" data-id="<?php echo $row['id'] ?>"
                                    class="dashicons dashicons-no button-secondary ">
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="8">هیچ داده‌ای یافت نشد</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    <?php
}

function update_auth_status_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $condition = isset($_POST['condition']) ? intval($_POST['condition']) : '';
    if ($id > 0) {
        $result = $wpdb->update(
            $table_name,
            ['auth_status' => $condition],
            ['id' => $id],
            ['%d'],
            ['%d']
        );
        if ($result !== false) {
            echo 'Success';
        } else {
            echo 'Error';
        }
    } else {
        echo 'Invalid ID';
    }
    wp_die();
}

function delete_nitro_row_callback()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $id = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';
    if (isset($_POST['id'])) {
        $wpdb->delete($table_name, array('ID' => $id));

        if ($wpdb->last_error) {
            wp_send_json_error($wpdb->last_error);
        } else {
            wp_send_json_success('Row deleted successfully');
        }
    } else {
        wp_send_json_error('ID not set');
    }
    wp_die();
}

function table_section_shortcode() {
    $nitro_access_token = $_COOKIE['nitro_access_token'] ?? '';
//    $response = api_get_challenge_prices($nitro_access_token);

    ob_start();
    ?>
    <div class="ncp-container-table d-flex center">
        <!-- btn parent -->
        <div class="ncp-prices d-flex">
            <!-- btns -->
            <div class="btn-price">
                <button class="ncp_btn_normal btn-table btn-active" id="btn-price-0" data-id="1"
                   data-price="$5000"
                   name="one">5000 $</button>
            </div>
            <div class="btn-price">
                <button class="ncp_btn_normal btn-table" id="btn-price-1" data-id="2" data-price="$10000"
                   name="two">10000 $</button>
            </div>
            <div class="btn-price">
                <button class="ncp_btn_normal btn-table" id="btn-price-2" data-id="3" data-price="$25000"
                   name="three">25000 $</button>
            </div>
            <div class="btn-price">
                <button class="ncp_btn_normal btn-table" id="btn-price-3" data-id="4" data-price="$50000"
                   name="four">50000 $</button>
            </div>
        </div>
        <div class="ncp-table w-100 d-flex center">
            <table class="w-100">
                <thead>
                <tr>
                    <th style="display: flex;">چالش‌ ها</th>
                    <th style="display: flex;">مرحله اول</th>
                    <th style="display: flex;">مرحله دوم</th>
                    <th style="display: flex;">مرحله سوم</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="display: flex;">اکانت منیجر شخصی</td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="display: flex;">تقسیم سود چالش</td>
                    <td style="display: flex;">5%</td>
                    <td style="display: flex;">5%</td>
                    <td style="display: flex;">-</td>
                </tr>
                <tr>
                    <td style="display: flex;">مدت زمان چالش</td>
                    <td style="display: flex;">نامحدود</td>
                    <td style="display: flex;">نامحدود</td>
                    <td style="display: flex;">نامحدود</td>
                </tr>
                <tr>
                    <td style="display: flex;">حداقل روزهای ترید</td>
                    <td style="display: flex;">5 روز</td>
                    <td style="display: flex;">5 روز</td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/delete.png' ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="display: flex;">حد ضرر روزانه</td>
                    <td style="display: flex;">5%</td>
                    <td style="display: flex;">5%</td>
                    <td style="display: flex;">5%</td>
                </tr>
                <tr>
                    <td style="display: flex;">حد ضرر کل</td>
                    <td style="display: flex;">12%</td>
                    <td style="display: flex;">12%</td>
                    <td style="display: flex;">12%</td>
                </tr>
                <tr>
                    <td style="display: flex;">تارگت سود</td>
                    <td style="display: flex;">8%</td>
                    <td style="display: flex;">4%</td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/delete.png' ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="display: flex;">ترید در زمان خبر</td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="display: flex;">سواپ فری</td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                    <td style="display: flex;"><img
                                src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/accept.png' ?>" alt="">
                    </td>
                </tr>
                <tr>
                    <td style="display: flex;">پلتفرم معامله</td>
                    <td style="display: flex;">MT5</td>
                    <td style="display: flex;">MT5</td>
                    <td style="display: flex;">MT5</td>
                </tr>
                <tr>
                    <td style="display: flex;">هزینه چالش</td>
                    <td id="payment-cell" style="display: flex;"><a>$59</a></td>
                    <td style="display: flex;">رایگان</td>
                    <td style="display: flex; font-size: 13px !important;">ریفاند هزینه</td>
                </tr>
                <tr>
                    <td style="display: flex;">هزینه چالش با تخفیف</td>
                    <?php echo is_front_page() || is_page('plans') ? '<td id="discounted-payment-cell" style="display: flex;"><a href="' . site_url() . '/panel/?land=challenge" class="ncp-table-btn">$42 خرید</a></td>' : '<td id="discounted-payment-cell" style="display: flex;"><a>$42</a></td>' ?>
                    <td style="display: flex;">رایگان</td>
                    <td style="display: flex; font-size: 13px !important;">ریفاند هزینه</td>
                </tr>
                </tbody>
            </table>
            <div class="table-btn-sec">
                <a href="" id="btn-next">></a>
                <a href="" id="btn-priv"><</a>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}




function nitro_slider()
{
    include_once NCP_PLUGIN_TEMPLATES . 'Slider/main-slider.php';
}