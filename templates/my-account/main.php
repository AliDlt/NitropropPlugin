<?php
defined('ABSPATH') or die('Access Denied!');
$upload_dir = wp_get_upload_dir();
$nitroLogo = $upload_dir['baseurl'] . '/2024/04/footerlogo.png';
$nitro_access_token = $_COOKIE['nitro_access_token'];
$account_info_response = api_account_info($nitro_access_token);
$cookie_name = "ncp_is_page";
$cookie_value = "dashboard";
$cookie_expiry = time() + 3600;
setcookie($cookie_name, $cookie_value, $cookie_expiry, "/");
if ($nitro_access_token && $account_info_response['status']==200) {
    $account_file_response = api_account_file($nitro_access_token);
    $datas = $account_file_response['data'];
} else {
    log_out_ncp();
    die();
}
?>
<div class="my-account-body">
    <div class="ncp-my-account-sidebar">
        <a href="/" id="ncp-logo-sec">
            <img class="ncp-logo" src="<?php echo $nitroLogo ?>" alt="site-logo">
        </a>
        <div class="ncp-main-menu">
            <a id="ncp-dashboard">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/Union.svg' ?>" alt="">
                    داشبورد
                </div>
            </a>
            <a id="ncp-challenge">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/06.svg' ?>" alt="">
                    خرید چالش
                </div>
            </a>
            <a id="ncp-request">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/04.svg' ?>" alt="">
                    ثبت درخواست
                </div>
            </a>
            <a id="ncp-withdrawal">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/05.svg' ?>" alt="">
                    برداشت سود
                </div>
            </a>
            <a id="ncp-authentication">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/03.svg' ?>" alt="">
                    احراز هویت
                </div>
            </a>
            <a id="ncp-profile">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/07.svg' ?>" alt="">
                    حساب کاربری
                </div>
            </a>
            <a id="ncp-support">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/08.svg' ?>" alt="">
                    پشتیبانی
                </div>
            </a>
            <a id="ncp-exit">
                <div class="ncp-menu-content">
                    <img class="menu-pointer" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/menu-pointer.svg' ?>" alt="">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/09.svg' ?>" alt="">
                    خروج
                </div>
            </a>
        </div>
    </div>
    <div class="ncp-my-account-container">
        <div class="ncp-my-account-header">
            <div class="ncp-right-header">
                <div class="ncp-hamburger" id="ncp-hamburger">
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/hamburger.svg' ?>" alt="">
                </div>
                <div class="select-option-sec">
                    <?php if ($datas){
                        ?>
                        <select class="btn-account-code appearance-none" name="status_id " id="status_id">
                            <?php
                            $first_array = 0;
                            foreach ($datas as $data) {
                                ?>
                               <option value="<?php echo $data['login'] ?>"
                                        data-array-id="<?php echo $first_array ?>"
                                        data-id="<?php echo $data['id'] ?>"
                                ><?php echo $data['login'] ?>
                                </option>
                                <?php
                                $first_array++;
                            }
                            ?>
                        </select>
<!--                        <img src="--><?php //echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/down.svg' ?><!--" alt="">-->
                        <?php
                    }else{
                        ?>
                            <div class="btn-account-code appearance-none">-</div>
                        <?php
                    } ?>
                </div>
                <div class="account-condition" id="account-condition">
                    <?php
                    $state = $datas[0]["state"];
                    echo state_svg($state)?:'';
                    ?>
                </div>
            </div>
            <div class="ncp-left-header">
                <!-- <img class="btn-account-bell" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/bell.svg' ?>" alt=""> -->
                <img class="btn-account-person" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/account.svg' ?>" alt="">
                <div class="btn-account-name" data-name="<?php echo $account_info_response['data']['fullname']?>">
                    <?php echo $account_info_response['data']['first_name_en']?>
                    <img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/down.svg' ?>" alt="">
                    <div class="dropdown-menu">
                        <a href="/panel/?land=profile">حساب کاربری</a>
                        <a id="npc-exit-profile">خروج</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="ncp-my-account-wrapper" id="ncp-my-account-wrapper">
            <?php
            if (isset($datas[0])) {
                echo dashboard_template($account_info_response, $datas[0]);
            } else {
                echo dashboard_template($account_info_response, null);
            }
            ?>
        </div>
        <div class="background-spinner" style="display: none">
            <span class="hs-spinner-gif my-account-loading" id="spinner-gif"></span>
        </div>
    </div>
</div>




