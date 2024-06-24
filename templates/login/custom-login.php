<div class="login-body">
    <div class="login-container">
        <div class="content-section " >
            <div id="login-content-section">
                <h1 class="title">ورود</h1>
                <form class="login-form" name="loginform" id="loginform"
                      action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                    <div class="input-container">
                        <label for="email">ایمیل</label>
                        <input type="email" id="email" name="email">
                        <svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                    d="M13.331 26.9301C9.8213 26.9301 6.31022 26.9301 2.80051 26.9301C2.49124 26.9301 2.18335 26.9204 1.87683 26.8555C1.17682 26.705 0.775045 26.2162 0.783329 25.4969C0.788852 24.9419 0.92692 24.4075 1.06085 23.8746C1.6435 21.555 2.73424 19.5061 4.36621 17.7568C5.63368 16.3982 7.11792 15.3433 8.84654 14.6378C9.06883 14.5467 9.21656 14.5757 9.40986 14.6806C10.4702 15.2591 11.6079 15.5877 12.8146 15.6664C14.4577 15.7741 15.9861 15.3958 17.4192 14.6005C17.5186 14.5453 17.6056 14.5439 17.7105 14.5867C19.649 15.3723 21.3003 16.5625 22.6631 18.1447C24.1487 19.8692 25.1414 21.8491 25.6661 24.0638C25.7558 24.4434 25.84 24.8231 25.8842 25.2111C25.9104 25.4417 25.9008 25.6695 25.8525 25.8945C25.7337 26.4385 25.3029 26.7906 24.6499 26.8845C24.3986 26.9204 24.1473 26.9287 23.8946 26.9287C20.3725 26.9287 16.8504 26.9287 13.3296 26.9287L13.331 26.9301Z"
                                    fill="#89ABEA"/>
                            <path
                                    d="M6.70646 7.17447C6.72993 3.65096 9.54377 0.612066 13.3324 0.59964C16.9139 0.588594 19.8975 3.56812 19.9183 7.13029C19.939 10.8236 16.9926 13.7976 13.3282 13.8059C9.66665 13.8142 6.70784 10.8443 6.70508 7.17447H6.70646Z"
                                    fill="#89ABEA"/>
                        </svg>
                    </div>
                    <div class="input-container">
                        <label for="password">رمزعبور</label>
                        <input type="password" id="password" name="password">
                        
                        <svg id="password-icon-visible" fill="#89ABEA" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" style="display: none;"><path d="M15 12c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3zm9-.449s-4.252 8.449-11.985 8.449c-7.18 0-12.015-8.449-12.015-8.449s4.446-7.551 12.015-7.551c7.694 0 11.985 7.551 11.985 7.551zm-7 .449c0-2.757-2.243-5-5-5s-5 2.243-5 5 2.243 5 5 5 5-2.243 5-5z"/></svg>

                        <svg id="password-icon-hidden" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#89ABEA" viewBox="0 0 24 24" style="display: block;"><path d="M11.885 14.988l3.104-3.098.011.11c0 1.654-1.346 3-3 3l-.115-.012zm8.048-8.032l-3.274 3.268c.212.554.341 1.149.341 1.776 0 2.757-2.243 5-5 5-.631 0-1.229-.13-1.785-.344l-2.377 2.372c1.276.588 2.671.972 4.177.972 7.733 0 11.985-8.449 11.985-8.449s-1.415-2.478-4.067-4.595zm1.431-3.536l-18.619 18.58-1.382-1.422 3.455-3.447c-3.022-2.45-4.818-5.58-4.818-5.58s4.446-7.551 12.015-7.551c1.825 0 3.456.426 4.886 1.075l3.081-3.075 1.382 1.42zm-13.751 10.922l1.519-1.515c-.077-.264-.132-.538-.132-.827 0-1.654 1.346-3 3-3 .291 0 .567.055.833.134l1.518-1.515c-.704-.382-1.496-.619-2.351-.619-2.757 0-5 2.243-5 5 0 .852.235 1.641.613 2.342z"/></svg>
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                    </div>
                    <div class="login-btn-sec">
                        <a class="primary-btn" id="ncp-login">
                            ورود
                            <span class="hs-spinner-gif" id="spinner-gif" style="display:none;"></span>
                        </a>
                        <a class="secondary-btn" id="register-template">عضو نیستم</a>
                    </div>
                    <p class="forgot-text" id="forget-pass-template">رمزعبور خود را فراموش کرده اید؟</p>
                    <input type="hidden" name="action" value="custom_login_action">
                </form>
            </div>
            <div class="background-spinner" style="display: none">
                <span class="hs-spinner-gif my-account-loading" id="spinner-gif"></span>
            </div>
        </div>
        <div class="cover-section">
            <img class="" id="login-logo-one" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/login-background.webp' ?>" alt="">
            <img id="login-logo-two" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/mobile-back.webp' ?>" alt="">
            <img id="login-logo" src="<?php echo NCP_PLUGIN_INCLUDES_URL . 'front-assets/img/logo-w.webp' ?>" alt="">
        </div>
    </div>
</div>