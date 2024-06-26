<?php
defined('ABSPATH') or die('Access Denied!');

function authentication_loader($account_info_response)
{
    $profile_info = $account_info_response['data'];
    global $wpdb;
    $table_name = $wpdb->prefix . 'nitro_table';
    $results = ($wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE account_id = %d", $profile_info['id']), ARRAY_A))[0];
    ob_start();
    ?>
    <div class="ncp-profile ncp-block">
        <h2>احراز هویت</h2>
        <div class="ncp-warning"><img src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/warning.svg' ?>"
                                      alt="توجه">
            اطلاعات ثبت شده قابل ویرایش نمی باشند. لطفا در وارد کردن اطلاعات دقت فرمایید.
        </div>
        <div class="field-auth-sec">
            <div class="ncp-profile-sec">
                <div class="ncp-profile-name-field">
                    <label>تاریخ تولد</label>
                    <input type="text" id="birth_date" name="birth_date" placeholder="1368/06/15"
                           value="<?php echo $results['birth_date'] ?>" <?php echo $results ? 'disabled' : '' ?>
                           data-jdp>
                </div>
                <div class="ncp-profile-name-field">
                    <label for="code_melli">کد ملی</label>
                    <input type="text" id="code_melli" name="code_melli" placeholder="کدملی خود را وارد کنید"
                           value="<?php echo $results['code_melli'] ?>" <?php echo $results ? 'disabled' : '' ?>>
                </div>

                <div class="ncp-upload-container">
                    <div class="ncp-upload-box">
                        <?php
                        if ($results['code_melli']) {
                            ?>
                            <img class="ncp-upload-label" src="<?php echo $results['cart_melli_url'] ?>" alt="">
                            <?php
                        } else {
                            ?>
                            <label for="cart_melli_upload" class="ncp-upload-label">
                                <img id="cart_melli_1"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/downloads.png' ?>"
                                     alt="">
                                <img id="cart_melli_2"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>"
                                     alt=""
                                     style="display: none">
                                فایل مورد نظر را انتخاب نمایید.
                            </label>
                            <input type="file" id="cart_melli_upload" class="ncp-file-input"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   required>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="ncp-upload-instructions">
                        <p>تصویر کارت ملی</p>
                        <ul>
                            <li>عکس کمتر از 15 مگابایت باشد.</li>
                            <li>عکس با کیفیت و واضح باشد.</li>
                            <li>در صورتی که کارت ملی ندارید می‌توانید از شناسنامه جدید و یا پاسپورت معتبر استفاده
                                نمایید.
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="ncp-upload-container">
                    <div class="ncp-upload-box">
                        <?php
                        if ($results['code_melli']) {
                            ?>
                            <img class="ncp-upload-label" src="<?php echo $results['selfie_url'] ?>" alt="">
                            <?php
                        } else {
                            ?>
                            <input type="file" id="selfie_upload" class="ncp-file-input" accept=".jpg,.jpeg,.png,.pdf"
                                   required>
                            <label for="selfie_upload" class="ncp-upload-label">
                                <img id="selfie_1"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/downloads.png' ?>" alt="">
                                <img id="selfie_2"
                                     src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/check-mark.svg' ?>" alt=""
                                     style="display: none">
                                فایل مورد نظر را انتخاب نمایید.
                            </label>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="ncp-upload-instructions">
                        <p>تصویر سلفی همراه با کارت ملی</p>
                        <ul>
                            <li>عکس کمتر از 15 مگابایت باشد.</li>
                            <li>کارت ملی و چهره شخص کاملا واضح در عکس مشخص باشد.</li>
                            <li>در صورتی که کارت ملی ندارید می توانید از شناسنامه جدید و یا پاسپورت معتبر استفاده نمایید
                                و همچنین در نظر داشته باشید که
                                نور و کیفیت عکس به گونه ای باشد که مدرک شناسایی و چهره شخص به خوبی مشخص باشد.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <a class="ncp_btn_normal <?php echo $results ? 'auth_form_send_disabled' : '' ?>" id="auth_form_send"
               data-account-id="<?php echo $profile_info['id'] ?>">
                ارسال
                <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}