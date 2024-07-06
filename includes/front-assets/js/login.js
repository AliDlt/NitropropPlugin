jQuery(function ($) {
    var sit_url = ajax_filter_params.siteUrl;
    var nonce = ajax_filter_params.nonce;

    // Toggle password visibility
    $(document).on('click', '#password-icon-hidden', function () {
        $('#password').attr('type', 'text');
        $('#password-icon-hidden').hide();
        $('#password-icon-visible').show();
    });

    $(document).on('click', '#password-icon-visible', function () {
        $('#password').attr('type', 'password');
        $('#password-icon-visible').hide();
        $('#password-icon-hidden').show();
    });

    $(document).on('click', '#repeatPassword-icon-hidden', function () {
        $('#repeatPassword').attr('type', 'text');
        $('#repeatPassword-icon-hidden').hide();
        $('#repeatPassword-icon-visible').show();
    });

    $(document).on('click', '#repeatPassword-icon-visible', function () {
        $('#repeatPassword').attr('type', 'password');
        $('#repeatPassword-icon-visible').hide();
        $('#repeatPassword-icon-hidden').show();
    });

    $(document).on('click', '#ncp-login-template', function () {
        login_template_leader();
    });

    $(document).on('click', '#forget-pass-template', function () {
        $('.background-spinner').fadeIn();
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_forget_pass_loader',
                nonce: nonce,
            },
            success: function (response) {
                $("#login-content-section").removeClass('register-container');
                $('#login-content-section').hide().html(response).fadeIn();
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast("خطایی در بارگذاری قالب رخ داده است.", "error");
                $('.background-spinner').fadeOut();
            }
        });
    });

    $(document).on('click', '#register-template', function () {
        $('.background-spinner').fadeIn();
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_register_loader',
                nonce: nonce,
            },
            success: function (response) {
                $("#login-content-section").addClass('register-container');
                $('#login-content-section').hide().html(response).fadeIn();
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast("خطایی در بارگذاری قالب رخ داده است.", "error");
                $('.background-spinner').fadeOut();
            }
        });
    });

    $(document).on('input', '#fullname', function () {
        var nonLatinRegex = /^[^\x00-\x7F\s]+(\s[^\x00-\x7F\s]+)*\s*$/;
        if ($(this).val().trim() === "") {
            $('#name-valid').hide();
        } else if (!nonLatinRegex.test($(this).val())) {
            $('#name-valid').show();
        } else {
            $('#name-valid').hide();
        }
    });

    $(document).on('input', '#phone', function () {
        var mobileRegex = /^0\d{10}$/;
        if ($(this).val().trim() === "") {
            $('#phone-valid').hide();
        } else if (!mobileRegex.test($(this).val())) {
            $('#phone-valid').show();
        } else {
            $('#phone-valid').hide();
        }
    });

    $(document).on('input', '#latinName', function () {
        var latinRegex = /^[a-zA-Z\s]+$/;
        if ($(this).val().trim() === "") {
            $('#name-en-valid').hide();
        } else if (!latinRegex.test($(this).val())) {
            $('#name-en-valid').show();
        } else {
            $('#name-en-valid').hide();
        }
    });

    $(document).on('input', '#latinlastName', function () {
        var latinRegex = /^[a-zA-Z\s]+$/;
        if ($(this).val().trim() === "") {
            $('#lname-en-valid').hide();
        } else if (!latinRegex.test($(this).val())) {
            $('#lname-en-valid').show();
        } else {
            $('#lname-en-valid').hide();
        }
    });

    $(document).on('input', '#email', function () {
        if ($(this).val().trim() === "") {
            $('#email-valid').hide();
        } else if (!validateEmail($(this).val())) {
            $('#email-valid').show();
        } else {
            $('#email-valid').hide();
        }
    });

    $(document).on('input', '#password', function () {
        if ($(this).val().trim() === "") {
            $('#pass-valid').hide();
        } else if ($(this).val().length < 8) {
            $('#pass-valid').show();
        } else {
            $('#pass-valid').hide();
        }
    });
    
    // Trigger login on Enter key press
    $(document).on('keypress', function(e) {
        if (e.which === 13 && $('#ncp-login').is(':visible')) {
            $('#ncp-login').click();
        }
    });

    // Trigger register on Enter key press
    $(document).on('keypress', function(e) {
        if (e.which === 13 && $('#ncp-register').is(':visible')) {
            $('#ncp-register').click();
        }
    });

    $(document).on('click', '#ncp-login', function () {
        let validation = true;
        let errors = [];
        let email = $('#email').val();
        let password = $('#password').val();

        if (!email) {
            validation = false;
            errors.push("ایمیل الزامی است.");
        }
        if (!password) {
            validation = false;
            errors.push("گذرواژه الزامی است.");
        }
        if (!validateEmail(email)) {
            validation = false;
            errors.push("آدرس ایمیل نامعتبر است.");
        }

        if (validation) {
            $('#spinner-gif').fadeIn();
            if (typeof grecaptcha !== 'undefined') {
                grecaptcha.enterprise.ready(function () {
                    grecaptcha.enterprise.execute('6LdzJvEpAAAAAIDr7heFS3Nlznm1qNHgI6u_YOsK', {action: 'LOGIN'}).then(function (token) {
                        $.ajax({
                            url: ajax_filter_params.ajax_url,
                            type: 'POST',
                            data: {
                                action: 'ncp_login',
                                password: password,
                                email: email,
                                nonce: nonce,
                                recaptcha_token: token
                            },
                            success: function (response) {
                                console.log(response);
                                if (response.success) {
                                    showToast("خوش آمدید", "success");
                                    window.location.href = sit_url + '/panel/?land=dashboard';
                                } else if (response.data.status === 401) {
                                    showToast(response.data.detail, 'error');
                                    $('#spinner-gif').fadeOut();
                                } else {
                                    showToast(response.data.message, 'error');
                                    $('#spinner-gif').fadeOut();
                                }
                            },
                            error: function (error) {
                                console.error("Error occurred:", error);
                                $('#spinner-gif').fadeOut();
                                showToast("ورود ناموفق بود. لطفاً اعتبار خود را بررسی کنید.", "error");
                            }
                        });
                    });
                });
            } else {
                console.error("reCAPTCHA is not loaded");
                $('#spinner-gif').fadeOut();
                showToast("بارگذاری reCAPTCHA ناموفق بود. لطفاً صفحه را دوباره بارگذاری کنید.", "error");
            }
        } else {
            showValidationErrors(errors);
        }
    });

    $(document).on('click', '#ncp-register', function () {
        let validation = true;
        let errors = [];
        let fullname = $('#fullname').val();
        let phone = $('#phone').val();
        let latinName = $('#latinName').val();
        let latinlastName = $('#latinlastName').val();
        let email = $('#email').val();
        let password = $('#password').val();
        let repeatPassword = $('#repeatPassword').val();
        let rule = $('#rule').prop('checked');

        var mobileRegex = /^0\d{10}$/;
        var latinRegex = /^[a-zA-Z\s]+$/;
        var nonLatinRegex = /^[^\x00-\x7F\s]+(\s[^\x00-\x7F\s]+)*\s*$/;
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
        console.log(nonLatinRegex.test(fullname))
        if (!fullname) {
            validation = false;
            errors.push("نام کامل الزامی است.");
        } else if (!nonLatinRegex.test(fullname)) {
            validation = false;
            errors.push("نام و نام خانوادگی نباید به زبان انگلیسی باشد.");
        }

        if (!phone) {
            validation = false;
            errors.push("شماره تلفن الزامی است.");
        } else if (!mobileRegex.test(phone)) {
            validation = false;
            errors.push("شماره تلفن نامعتبر است. فرمت صحیح 09121891332 است");
        }

        if (!latinName) {
            validation = false;
            errors.push("نام لاتین الزامی است.");
        } else if (!latinRegex.test(latinName)) {
            validation = false;
            errors.push("نام لاتین باید به زبان انگلیسی باشد.");
        }

        if (!latinlastName) {
            validation = false;
            errors.push("نام خانوادگی لاتین الزامی است.");
        } else if (!latinRegex.test(latinlastName)) {
            validation = false;
            errors.push("نام خانوادگی لاتین باید به زبان انگلیسی باشد.");
        }

        if (!email) {
            validation = false;
            errors.push("ایمیل الزامی است.");
        } else if (!validateEmail(email)) {
            validation = false;
            errors.push("آدرس ایمیل نامعتبر است.");
        }

        if (!password) {
            validation = false;
            errors.push("گذرواژه الزامی است.");
        } else if (!passwordRegex.test(password)) {
            validation = false;
            errors.push("پسورد شما باید حداقل 8 کاراکتر و شامل حروف بزرگ و کوچک باشد.");
        } else if (password !== repeatPassword) {
            validation = false;
            errors.push("گذرواژه‌ها مطابقت ندارند.");
        }

        if (!rule) {
            validation = false;
            errors.push("باید قوانین را بپذیرید.");
        }

        if (!validation) {
            showValidationErrors(errors);
        } else {
            grecaptcha.enterprise.ready(function () {
                grecaptcha.enterprise.execute('6LdzJvEpAAAAAIDr7heFS3Nlznm1qNHgI6u_YOsK', {action: 'LOGIN'}).then(function (token) {
                    $('#spinner-gif').fadeIn();
                    $.ajax({
                        url: ajax_filter_params.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'ncp_register',
                            fullname: fullname,
                            phone: phone,
                            latinName: latinName,
                            latinlastName: latinlastName,
                            password: password,
                            repeatPassword: repeatPassword,
                            email: email,
                            recaptcha_token: token,
                            nonce: nonce,
                        },
                        success: function (response) {
                            if (response.code === 201) {
                                showToast(response.message, "success");
                                login_template_leader();
                            } else {
                                if (response.code === 400) {
                                    let errorList = [];
                                    if (response.data.hasOwnProperty('email')) {
                                        errorList.push(response.data.email[0]);
                                    }
                                    if (response.data.hasOwnProperty('password')) {
                                        errorList.push(response.data.password[0]);
                                    }
                                    if (response.data.hasOwnProperty('phone_number')) {
                                        errorList.push(response.data.phone_number[0]);
                                    }
                                    showValidationErrors(errorList);
                                } else {
                                    showToast(response.message, "error");
                                }
                                $('#spinner-gif').fadeOut();
                            }
                        },
                        error: function (error) {
                            console.error("Error occurred:", error);
                            showToast("خطایی در هنگام ثبت‌نام رخ داد.", "error");
                            $('#spinner-gif').fadeOut();
                        }
                    });
                })
            })
        }
    });

    $(document).on('click', '#ncp-send-email', function () {
        let validation = true;
        let email = $('#email').val();
        let errors = [];
        if (!email) {
            validation = false;
            errors.push("ایمیل الزامی است.");
        } else if (!validateEmail(email)) {
            validation = false;
            errors.push("آدرس ایمیل نامعتبر است.");
        }
        if (validation) {
            $('#spinner-gif').fadeIn();
            grecaptcha.enterprise.ready(function () {
                grecaptcha.enterprise.execute('6LdzJvEpAAAAAIDr7heFS3Nlznm1qNHgI6u_YOsK', {action: 'LOGIN'}).then(function (token) {
                    $.ajax({
                        url: ajax_filter_params.ajax_url,
                        type: 'POST',
                        data: {
                            action: 'ncp_forget_pass',
                            email: email,
                            nonce: nonce,
                            recaptcha_token: token
                        },
                        success: function (response) {
                            if (response.code === 200) {
                                showToast(response.message, "success");
                            } else {
                                if (response.data.message){
                                    showToast(response.data.message, "error");
                                }else {
                                    showToast('مشکلی پیش آمده', "error");
                                }
                            }
                            $('#spinner-gif').fadeOut();
                        },
                        error: function (error) {
                            console.error("Error occurred:", error);
                            showToast("خطایی در هنگام ارسال ایمیل رخ داد.", "error");
                            $('#spinner-gif').fadeOut();
                        }
                    });
                })
            })
        } else {
            showValidationErrors(errors);
        }
    });

    function login_template_leader() {
        $('.background-spinner').fadeIn();
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_login_loader',
                nonce: nonce,
            },
            success: function (response) {
                $("#login-content-section").removeClass('register-container');
                $('#login-content-section').hide().html(response).fadeIn();
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast("خطایی در بارگذاری قالب رخ داده است.", "error");
                $('.background-spinner').fadeOut();
            }
        });
    }

    function validateEmail(email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email);
    }

    function showValidationErrors(errors) {
        let errorMessages = errors.slice(0, 3);
        errorMessages.forEach(error => {
            showToast(error, "error");
        });
    }

    function showToast(message, type) {
        Toastify({
            text: message,
            duration: 3000,
            closeButton: false,
            gravity: "top",
            position: "right",
            newWindow: true,
            stopOnFocus: true,
            style: {
                background: type === 'success' ? "green" : "red",
                direction: "rtl",
                color: type === 'success' ? "white" : "#fff",
                borderRadius: "14px",
                minWidth: "150px",
                boxShadow: "0 3px 6px rgba(0,0,0,0.1)",
                fontFamily: "kalameh, sans-serif",
                fontSize: "16px",
                textAlign: "center",
            }
        }).showToast();
    }
});
