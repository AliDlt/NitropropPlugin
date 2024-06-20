<?php
defined('ABSPATH') or die('Access Denied!');
function forget_pass_template()
{
    return '
    <h1 class="title">بازیابی رمز عبور</h1>
            <div class="input-container" style="margin-bottom: 5px;">
                <label for="email">ایمیل</label>
                <div class="input-con">
                    <input type="email" id="email" name="email">
                    <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M13.331 26.9301C9.8213 26.9301 6.31022 26.9301 2.80051 26.9301C2.49124 26.9301 2.18335 26.9204 1.87683 26.8555C1.17682 26.705 0.775045 26.2162 0.783329 25.4969C0.788852 24.9419 0.92692 24.4075 1.06085 23.8746C1.6435 21.555 2.73424 19.5061 4.36621 17.7568C5.63368 16.3982 7.11792 15.3433 8.84654 14.6378C9.06883 14.5467 9.21656 14.5757 9.40986 14.6806C10.4702 15.2591 11.6079 15.5877 12.8146 15.6664C14.4577 15.7741 15.9861 15.3958 17.4192 14.6005C17.5186 14.5453 17.6056 14.5439 17.7105 14.5867C19.649 15.3723 21.3003 16.5625 22.6631 18.1447C24.1487 19.8692 25.1414 21.8491 25.6661 24.0638C25.7558 24.4434 25.84 24.8231 25.8842 25.2111C25.9104 25.4417 25.9008 25.6695 25.8525 25.8945C25.7337 26.4385 25.3029 26.7906 24.6499 26.8845C24.3986 26.9204 24.1473 26.9287 23.8946 26.9287C20.3725 26.9287 16.8504 26.9287 13.3296 26.9287L13.331 26.9301Z"
                                fill="#89ABEA" />
                        <path
                                d="M6.70646 7.17447C6.72993 3.65096 9.54377 0.612066 13.3324 0.59964C16.9139 0.588594 19.8975 3.56812 19.9183 7.13029C19.939 10.8236 16.9926 13.7976 13.3282 13.8059C9.66665 13.8142 6.70784 10.8443 6.70508 7.17447H6.70646Z"
                                fill="#89ABEA" />
                    </svg>
                    <div class="error-sec" id="email-error-sec">
                        <p class="input-error" id="email-error" style="display: none">لطفا ایمیل خود را وارد کنید!</p>
                        <p class="input-error" id="email-valid" style="display: none">لطفا ایمیل خود را به صورت صحیح وارد کنید!</p>
                        <p class="input-success" id="email-success" style="display: none">ایمیل برای شما ارسال شد.</p>
                    </div>
                </div>
            </div>
            <div class="error-message" style="text-align: start;"></div>
            <div class="btn-container">
                <a class="primary-btn" id="ncp-send-email">
                ارسال لینک
                <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
                </a>
                <a class="secondary-btn" id="ncp-login-template">بازگشت به ورود</a>
            </div>
    ';
}