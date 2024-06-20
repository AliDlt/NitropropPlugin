<?php
defined('ABSPATH') or die('Access Denied!');
function profile_template( $account_info_response)
{
    $profile_info = $account_info_response['data'];
    ob_start();
    ?>
    <div class="ncp-profile ncp-block">
        <h2>حساب کاربری</h2>
        <div class="ncp-warning"><img
                    src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/warning.svg' ?>" alt="">برای
            تغییر اطلاعات کاربری خود از طریق پشتیبانی آنلاین و یا تیکت اقدام نمایید.
        </div>
        <div class="field-sec">
            <div class="ncp-profile-sec">
                <div class="ncp-profile-name-field">
                    <span>نام و نام خانوادگی</span>
                    <input type="text" value="<?php echo $profile_info['fullname'] ?>" disabled>
                </div>
                <div class="ncp-profile-mobile-field">
                    <span>شماره موبایل</span>
                    <input type="text" value="<?php echo $profile_info['phone_number'] ?>" disabled>
                </div>
                <div class="ncp-profile-name-latin-field">
                    <span>نام به لاتین</span>
                    <input type="text" value="<?php echo $profile_info['first_name_en'] ?>" disabled>
                </div>
                <div class="ncp-profile-fname-latin-field">
                    <span>نام خانوادگی به لاتین</span>
                    <input type="text" value="<?php echo $profile_info['last_name_en'] ?>" disabled>
                </div>
                <div class="ncp-profile-email-field">
                    <span>ایمیل</span>
                    <input type="text" value="<?php echo $profile_info['email'] ?>" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="ncp-block">
        <h2>تغییر رمز عبور</h2>
        <div class="pass-change-block">
            <div class="ncp-pass-change-sec">
                <div class="ncp-old-pass-field">
                    <span>رمز عبور فعلی</span>
                    <input type="text" value="" id="old-pass">
                </div>
                <div class="ncp-new-pass-field">
                    <span>رمز عبور جدید</span>
                    <input type="text" value="" id="new-pass">
                </div>
            </div>
            <div class="error-sec change-pass">
                <p class="input-error" id="change-pass-error" style="display: none">مقادیر را درست وارد کنید</p>
                <p class="input-success" id="change-pass-success" style="display: none">رمز عبور شما تغییر کرد</p>
            </div>
            <a id="ncp-change-pass" class="ncp_btn_normal">ثبت</a>
        </div>
    </div>
    <?php
    return ob_get_clean();;
}