<?php
defined('ABSPATH') or die('Access Denied!');
function register_template()
{
    ob_start();
    ?>
    <h1 class="title">ثبت نام</h1>
    <div class="twoCol-container">
        <div class="input-container">
            <label for="fullname">نام و نام خانوادگی</label>
            <div class="input-con">
                <input type="text" name="fullname" id="fullname">
            </div>
            <div class="error-sec">
                <p class="input-error" id="name-error" style="display: none">لطفا نام و نام خانوادگی خود را وارد کنید!</p>
                <p class="input-error" id="name-valid" style="display: none">نام و نام خانوادگی نباید به زبان انگلیسی باشد!</p>
            </div>
        </div>
        <div class="input-container">
            <label for="phone">شماره تماس</label>
            <div class="input-con">
                <input type="text" name="phone" id="phone">
            </div>
            <div class="error-sec" id="phone-number-error-sec">
                <p class="input-error" id="phone-error" style="display: none">لطفا شماره تماس خود را وارد کنید!</p>
                <p class="input-error" id="phone-valid" style="display: none">لطفا شماره تماس خود را درست وارد کنید! فرمت صحیح 09123456789 است</p>
            </div>
        </div>
    </div>
    <div class="twoCol-container">
        <div class="input-container">
            <label for="latinName">نام لاتین</label>
            <div class="input-con">
                <input type="text" name="latinName" id="latinName">
            </div>
            <div class="error-sec">
                <p class="input-error" id="name-en-error" style="display: none">لطفا نام انگلیسی خود را وارد کنید!</p>
                <p class="input-error" id="name-en-valid" style="display: none">نام لاتین باید به زبان انگلیسی باشد!</p>
            </div>
        </div>
        <div class="input-container">
            <label for="latinlastName">نام خانوادگی لاتین</label>
            <div class="input-con">
                <input type="text" name="latinlastName" id="latinlastName">
            </div>
            <div class="error-sec">
                <p class="input-error" id="lname-en-error" style="display: none">لطفا نام خانوادگی انگلیسی خود را وارد کنید!</p>
                <p class="input-error" id="lname-en-valid" style="display: none">نام خانوادگی لاتین باید به زبان انگلیسی باشد!</p>
            </div>
        </div>
    </div>
    <div class="input-container">
        <label for="email">ایمیل</label>
        <div class="input-con">
            <input type="email" id="email" name="email">
        </div>
        <div class="error-sec" id="email-error-sec">
            <p class="input-error" id="email-error" style="display: none">لطفا ایمیل خود را وارد کنید!</p>
            <p class="input-error" id="email-valid" style="display: none">لطفا ایمیل خود را به صورت صحیح وارد کنید!</p>
        </div>
    </div>
    <div class="twoCol-container">
        <div class="input-container">
            <label for="password">رمزعبور</label>
            <div class="input-con">
                <input type="password" id="password" name="password">
                <svg id="password-icon-visible" fill="#89ABEA" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="display: none;"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>

                <svg id="password-icon-hidden" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#89ABEA" viewBox="0 0 24 24" style="display: block;"><path d="M11.885 14.988l3.104-3.098.011.11c0 1.654-1.346 3-3 3l-.115-.012zm8.048-8.032l-3.274 3.268c.212.554.341 1.149.341 1.776 0 2.757-2.243 5-5 5-.631 0-1.229-.13-1.785-.344l-2.377 2.372c1.276.588 2.671.972 4.177.972 7.733 0 11.985-8.449 11.985-8.449s-1.415-2.478-4.067-4.595zm1.431-3.536l-18.619 18.58-1.382-1.422 3.455-3.447c-3.022-2.45-4.818-5.58-4.818-5.58s4.446-7.551 12.015-7.551c1.825 0 3.456.426 4.886 1.075l3.081-3.075 1.382 1.42zm-13.751 10.922l1.519-1.515c-.077-.264-.132-.538-.132-.827 0-1.654 1.346-3 3-3 .291 0 .567.055.833.134l1.518-1.515c-.704-.382-1.496-.619-2.351-.619-2.757 0-5 2.243-5 5 0 .852.235 1.641.613 2.342z"/></svg>
            </div>
            <div class="error-sec" id="password-error-sec">
                <p class="input-error" id="pass-error" style="display: none">لطفا پسورد خود را وارد کنید!</p>
                <p class="input-error" id="pass-valid" style="display: none">پسورد شما باید حداقل 8 کاراکتر باشد!</p>
                <p class="input-error" id="register-error" style="display: none">مشکلی پیش آمده است!</p>
                <p class="input-success" id="register-success" style="display: none">اکانت شما ساخته شد!</p>
            </div>
        </div>
        <div class="input-container">
            <label for="repeatPassword">تکرار رمز عبور</label>
            <div class="input-con">
                <input type="password" id="repeatPassword" name="repeatPassword">
                <svg id="repeatPassword-icon-visible" fill="#89ABEA" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="display: none;"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>

                <svg id="repeatPassword-icon-hidden" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#89ABEA" viewBox="0 0 24 24" style="display: block;"><path d="M11.885 14.988l3.104-3.098.011.11c0 1.654-1.346 3-3 3l-.115-.012zm8.048-8.032l-3.274 3.268c.212.554.341 1.149.341 1.776 0 2.757-2.243 5-5 5-.631 0-1.229-.13-1.785-.344l-2.377 2.372c1.276.588 2.671.972 4.177.972 7.733 0 11.985-8.449 11.985-8.449s-1.415-2.478-4.067-4.595zm1.431-3.536l-18.619 18.58-1.382-1.422 3.455-3.447c-3.022-2.45-4.818-5.58-4.818-5.58s4.446-7.551 12.015-7.551c1.825 0 3.456.426 4.886 1.075l3.081-3.075 1.382 1.42zm-13.751 10.922l1.519-1.515c-.077-.264-.132-.538-.132-.827 0-1.654 1.346-3 3-3 .291 0 .567.055.833.134l1.518-1.515c-.704-.382-1.496-.619-2.351-.619-2.757 0-5 2.243-5 5 0 .852.235 1.641.613 2.342z"/></svg>
            </div>
        </div>
    </div>
    <div class="rule-container">
        <input id="rule" name="rule" type="checkbox">
        <label for="rule">تمامی قوانین را خوانده و می‌پذیرم</label>
        <div class="error-sec rules-error" id="rules-error-sec">
            <p class="input-error" id="rules-error" style="display: none">لطفا با قوانین موافقت کنید!</p>
        </div>
    </div>
    <div class="login-btn-sec">
        <a class="primary-btn" id="ncp-register">
            عضویت
            <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
        </a>
        <a class="secondary-btn" id="ncp-login-template">عضو هستم</a>
    </div>
    <?php
    return ob_get_clean();
}
?>
