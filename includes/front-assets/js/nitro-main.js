jQuery(function ($) {
    var dataId = null;
    var site_url = ajax_filter_params.siteUrl;
    var nonce = ajax_filter_params.nonce;
    const urlParams = new URLSearchParams(window.location.search);
    const land = urlParams.get('land');
    let nitro_access_token = $.cookie('nitro_access_token');
    var acc = document.getElementsByClassName("accordion");
    var i;
    var reloadRequest;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }

    $(document).ready(function () {
        $('.background-spinner').fadeIn();
        $('#ncp-withdrawal').on('click', function () {
            $('.background-spinner').fadeIn();
            var selectedOption = $('#status_id ').find('option:selected');
            var dataArrayId = selectedOption.data('array-id');
            var dataId = selectedOption.data('id');
            var dataArrayVal = selectedOption.val();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_withdrawal_loader',
                    nonce: nonce,
                    dataArrayId: dataArrayId,
                    dataId:dataId,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response)
                    $('.background-spinner').fadeOut();
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-withdrawal .menu-pointer').fadeIn();
                    history.pushState(null, '', '?land=withdrawal');
                    setCookie('ncp_is_page', 'withdrawal', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                },
                complete: function (){
                    $('#withdrawal-type ').val(dataArrayVal).select();
                    clearInterval(reloadRequest);
                }
            })
        });
        $('#ncp-challenge').on('click', function () {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_challenge_loader',
                    nonce: nonce,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response);
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-challenge .menu-pointer').fadeIn();
                    table_loader();
                    history.pushState(null, '', '?land=challenge');
                    setCookie('ncp_is_page', 'challenge', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                },
                complete: function () {
                    $('.background-spinner').fadeOut();
                    clearInterval(reloadRequest);
                }
            });
        });
        $('#ncp-dashboard').on('click', function () {
            $('.background-spinner').fadeIn();
            var selectedOption = $('#status_id ').find('option:selected');
            var dataArrayId = selectedOption.data('array-id');
            dataId = selectedOption.data('id');
            dashboardAjaxLoader(dataArrayId, dataId, 1);
        });
        
        
        $('#ncp-request').on('click', function () {
            $('.background-spinner').fadeIn();
            var selectedOption = $('#status_id ').find('option:selected');
            var dataArrayId = selectedOption.data('array-id');
            var dataId = selectedOption.data('id');
            var dataArrayVal = selectedOption.val();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_requests_loader',
                    nonce: nonce,
                    dataArrayId: dataArrayId,
                    dataArrayVal: dataArrayVal,
                    dataId:dataId,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response);
                    // $('.background-spinner').fadeOut();
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-request .menu-pointer').fadeIn();
                    history.pushState(null, '', '?land=request');
                    setCookie('ncp_is_page', 'request', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                },
                complete: function (){
                    stateLoader(dataArrayId,function (){
                        $('#request-account ').val(dataArrayVal).select();
                        $('.background-spinner').fadeOut();
                    })
                    clearInterval(reloadRequest);
                }
            })
        });
        $('#ncp-profile').on('click', function () {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_profile_loader',
                    nonce: nonce,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response);
                    $('.background-spinner').fadeOut();
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-profile .menu-pointer').fadeIn();
                    history.pushState(null, '', '?land=profile');
                    setCookie('ncp_is_page', 'profile', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                }
            })
        });
        $('#ncp-authentication').on('click', function () {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_authentication_loader',
                    nonce: nonce,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response);
                    $('.background-spinner').fadeOut();
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-authentication .menu-pointer').fadeIn();
                    history.pushState(null, '', '?land=authentication');
                    setCookie('ncp_is_page', 'authentication', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                },
                complete: function () {
                    clearInterval(reloadRequest);
                }
            })
        });
        $('#ncp-support').on('click', function () {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_support_loader',
                    nonce: nonce,
                },
                success: function (response) {
                    $('#ncp-my-account-wrapper').html(response);
                    $('.background-spinner').fadeOut();
                    $('.ncp-menu-content .menu-pointer').fadeOut();
                    $('#ncp-support .menu-pointer').fadeIn();
                    history.pushState(null, '', '?land=support');
                    setCookie('ncp_is_page', 'support', 7);
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    if (error.status === 403) {
                        showToast("صفحه را دوباره بارگذاری کنید!", 'error');
                    } else {
                        showToast(error.statusText, 'error');
                    }
                    $('.background-spinner').fadeOut();
                },
                complete: function () {
                    clearInterval(reloadRequest);
                }
            })
        });
        $('#ncp-exit').on('click', function () {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_exit',
                    nonce: nonce,
                },
                success: function (response) {
                    window.location.href = site_url + '/login-register';
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    showToast(error.statusText, 'error');
                    $('.background-spinner').fadeOut();
                }
            })
        });
        $('#npc-exit-profile').on('click', function () {
            $('.background-spinner').fadeIn();
            $('#ncp-exit').trigger('click');
        });
        $('#ncp-hamburger').on('click', function () {
            $('.ncp-my-account-sidebar').toggleClass('active');
        })
        $('.ncp-my-account-sidebar a').click(function () {
            $('.ncp-my-account-sidebar').removeClass('active');
        });
        $(document).click(function (event) {
            if (!$(event.target).closest('.ncp-my-account-sidebar').length && !$(event.target).closest('.ncp-hamburger').length) {
                if ($('.ncp-my-account-sidebar').hasClass('active')) {
                    $('.ncp-my-account-sidebar').removeClass('active');
                }
            }
        });
        if (land === 'authentication') {
            $('#ncp-authentication').trigger('click');
        } else if (land === 'withdrawal') {
            $('#ncp-withdrawal').trigger('click');
        } else if (land === 'challenge') {
            $('#ncp-challenge').trigger('click');
        } else if (land === 'request') {
            $('#ncp-request').trigger('click');
        } else if (land === 'profile') {
            $('#ncp-profile').trigger('click');
        } else if (land === 'dashboard') {
            $('.background-spinner').fadeOut();
            // $('#ncp-dashboard').trigger('click');
        } else if (land === 'support') {
            $('#ncp-support').trigger('click');
        } else {
            $('#ncp-dashboard').trigger('click');
        }
    });

    $(document).on('click', '#birth_date', function (e) {
        e.preventDefault();
        jalaliDatepicker.startWatch({
            hideAfterChange: true,
            autoHide:true,
            showTodayBtn:false,
            showEmptyBtn:false,
            showCloseBtn:true,
            useDropDownYears:true
        });
    });
    $(document).on('click', '#buy-challenge', function (e) {
        e.preventDefault();
        let discount = true;
        let discountCode = $('#discount-code').val();
        let groupID = $('.btn-table.btn-active').data('id');
        let paymentMethod = $('.payment-btn.btn-active').data('method');
        let pay_back = $('#challenge-pay-back').prop('checked');
        let challenge_rule = $('#challenge-rule').prop('checked');
        if (!pay_back || !challenge_rule) {
            showToast('پذیرفتن قوانین الزامیست', 'error')
            $('.background-spinner').fadeOut();
            discount = false;
        }
        if (discount) {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_challenges_buy',
                    nonce: nonce,
                    groupID: groupID,
                    paymentMethod: paymentMethod,
                    discountCode: discountCode
                },
                success: function (response) {
                    if (response.code === 200){
                        window.location.href = response.data.link;
                    }else {
                        showToast(response.data, 'error')
                    }
                    $('.background-spinner').fadeOut();
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    showToast(error.statusText, 'error');
                    $('.background-spinner').fadeOut();
                }
            })
        }

    })
    $(document).on('click', '.ncp-discount .ncp_btn_normal', function (e) {
        e.preventDefault();
        let groupID = $('.btn-table.btn-active').data('id');
        let code = $('#discount-code').val();
        let discount = true;
        let errors = [];
        if (!code) {
            errors.push("کد تخفیف را وارد کنید!");
            discount = false;
        }
        if (discount) {
            $('#spinner-gif').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_discount_check',
                    nonce: nonce,
                    code: code,
                    groupID: groupID,
                },
                success: function (response) {
                    if (response.discount_amount !== 0) {
                        $('#rial-price').text(response.ir_price_formatted);
                        $('#dollar-price').text(response.usd_price);
                        $('#discount-code').prop('disabled', true);
                        $('.ncp-discount .ncp_btn_normal').prop('disabled', true);
                        showToast('کد تخفیف اعمال شد', 'success')
                    } else {
                        showToast('کد تخفیف اشتباه است', 'error')
                    }
                    $('#spinner-gif').fadeOut();
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    showToast(error.statusText, 'error');
                    $('#spinner-gif').fadeOut();
                }
            })
        } else {
            $('#spinner-gif').fadeOut();
            showValidationErrors(errors);
        }
    })
    $(document).on('click', '#withdrawal-btn', function (e) {
        e.preventDefault();
        let code = $('#withdrawal-input').val()
        var dataId = $('#withdrawal-btn').data('id');
        var selectedOption = $('#withdrawal-type').find('option:selected');
        var dataArrayVal = selectedOption.val();
        var dataArrayId = selectedOption.data('array-id');
        if (code) {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_withdrawal_request',
                    nonce: nonce,
                    code: code,
                    dataId: dataId,
                    dataArrayVal:dataArrayVal,
                    dataArrayId:dataArrayId
                },
                success: function (response) {
                    showToast('درخواست شما ارسال شد', 'success')
                    $('#ncp-withdrawal').trigger('click')
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    showToast(error.statusText, 'error');
                    $('.background-spinner').fadeOut();
                }
            })
        } else {
            showToast('آدرس کیف پول را خالیست!', 'error')
            $('.background-spinner').fadeOut();
        }
    })
    $(document).on('click', '#birth_date', function (e) {
        e.preventDefault();
        var $this = $(this);
        $('#code_melli').trigger('focus');
        setTimeout(function() {
            $this.trigger('focus');
        }, 100);
    })
    $(document).on('click', '#auth_form_send', function (e) {
        e.preventDefault();
        let birth_date = $('#birth_date').val();
        let code_melli = $('#code_melli').val();
        let cart_melli_upload = $('#cart_melli_upload')[0].files[0];
        let selfie_upload = $('#selfie_upload')[0].files[0];
        let validation = true;
        var errors = [];
        if (!code_melli) {
            errors.push('لطفا کد ملی خود را وارد کنید!')
            validation = false;
        }
        if (!birth_date) {
            errors.push('لطفا تاریخ تولد خود را وارد کنید!')
            validation = false;
        }
        if (!cart_melli_upload) {
            errors.push('عکس کارت ملی خود را آپلود کنید!')
            validation = false;
        }
        if (!selfie_upload) {
            errors.push('عکس سلفی خود را آپلود کنید!')
            validation = false;
        }
        if (validation) {
            $('#spinner-gif').fadeIn();
            var formData = new FormData();
            formData.append('action', 'upload_authentication_form');
            formData.append('nonce', nonce);
            formData.append('cart_melli_upload', cart_melli_upload);
            formData.append('selfie_upload', selfie_upload);
            formData.append('account_id', $(this).data('account-id'));
            formData.append('full_name', $('.btn-account-name').data('name'));
            formData.append('birth_date', birth_date);
            formData.append('code_melli', code_melli);
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        showToast('اطلاعات ارسال شد', 'success')
                        $('#ncp-authentication').trigger('click')
                    } else {
                        showToast(response.data.message, 'error')
                    }
                    $('#spinner-gif').fadeOut();
                },
                error: function (error) {
                    showToast('خطا در ارسال اطلاعات', 'error')
                    showToast(error.statusText, 'error');
                    $('#spinner-gif').fadeOut();
                }
            });
        } else {
            $('.background-spinner').fadeOut();
            showValidationErrors(errors);
        }

    })
    $(document).on('click', '#ncp-change-pass', function (e) {
        e.preventDefault();
        let validation = true;
        var errors = [];
        let oldPass = $('#old-pass').val();
        let newPass = $('#new-pass').val();
        if (!oldPass) {
            errors.push('پسورد خود را وارد کنید!')
            validation = false;
        }
        if (!newPass) {
            errors.push('پسورد جدید خود را وارد کنید!')
            validation = false;
        }
        if (validation) {
            $('.background-spinner').fadeIn();
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_pass_changer',
                    nonce: nonce,
                    oldPass: oldPass,
                    newPass: newPass,
                },
                success: function (response) {
                    if (response.code === 400) {
                        showToast(response.message, 'error')
                    } else {
                        showToast('پسورد شما عوض شد', 'success')
                    }
                    $('.background-spinner').fadeOut();
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                    showToast(error.statusText, 'error');
                    $('.background-spinner').fadeOut();
                }
            })
        } else {
            showValidationErrors(errors);
        }
    })
    $(document).on('click', '#main-pass-clipboard', function (e) {
        e.preventDefault();
        var text = $(this).closest('.right-info').text().trim();
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(text).select();
        document.execCommand("copy");
        tempInput.remove();
        showToast("کپی شد!", "success");
    })
    $(document).on('click', '#login-clipboard', function (e) {
        e.preventDefault();
        var text = $(this).closest('.right-info').text().trim();
        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(text).select();
        document.execCommand("copy");
        tempInput.remove();
        showToast("کپی شد!", "success");
    })
    $(document).on('click', '#ncp-btn-request', function (e) {
        e.preventDefault();
        // $('#ncp-request').trigger('click')
        let description = $('#request-description').val();
        let request_type = $('#request-type').val();
        var selectedOption = $('#status_id ').find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        var dataId = selectedOption.data('id');
        var dataArrayVal = selectedOption.val();
        // $('.background-spinner').fadeIn();
        var formData = new FormData();
        formData.append('action', 'ncp_request_send');
        formData.append('nonce', nonce);
        formData.append('request_type', request_type);
        formData.append('description', description);
        formData.append('dataArrayId', dataArrayId);
        formData.append('dataId', dataId);
        formData.append('dataArrayVal', dataArrayVal);
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.res.code === 201) {
                    $('#ncp-request').trigger('click')
                    showToast('درخواست ارسال شد', 'success');

                    // $('.ncp-request-list').html(response.listHTML);
                } else {
                    showToast('درخواست ارسال نشد', 'error');
                }
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            },
            complete: function () {
                clearInterval(reloadRequest);
            }
        });
    })
    $(document).on('click', '.payment-btn', function (e) {
        e.preventDefault();

        // Remove 'btn-active' class from all payment buttons
        $('.payment-btn').removeClass('btn-active');

        // Add 'btn-active' class to the clicked button
        $(this).addClass('btn-active');

        // Get the text of the clicked button
        var selectedText = $(this).text();

        // Update the paragraph with the selected payment method text
        $('.selected-payment').text('شما ' + selectedText + ' را انتخاب کرده اید');
    });
    $(document).on('click', '#payment-digital', function (e) {
        e.preventDefault();
        $('#payment-warning-text').text('برای خرید از درگاه ارز دیجیتال لطفا فیلترشکن خود را روشن نمایید.');
    });

    $(document).on('click', '#payment-rial', function (e) {
        e.preventDefault();
        $('#payment-warning-text').text('توجه داشته باشید که اطلاعات وارد شده با اطلاعات دارنده کارت بانکی یکسان باشد.');
    });
    $(document).on('click', '#refresh-dashboard', function (e) {
        e.preventDefault();
        $('.background-spinner').fadeIn();
        var selectedOption = $('#status_id').find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        dataId = selectedOption.data('id');
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_dashboard_loader',
                nitro_access_token: nitro_access_token,
                nonce: nonce,
                dataArrayId: dataArrayId,
                dataId:dataId,
            },
            success: function (response) {
                $('#dashboard-content').html(response.template);
                $('#account-condition').html(response.step)
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            }
        })
    });
    

    $(document).on('change', '#cart_melli_upload', function (e) {
        e.preventDefault();
        if ($(this).val()) {
            $('#cart_melli_1').hide();
            $('#cart_melli_2').show();
        }
    })
    $(document).on('change', '#selfie_upload', function (e) {
        e.preventDefault();
        if ($(this).val()) {
            $('#selfie_1').hide();
            $('#selfie_2').show();
        }
    })
    $(document).on('change', '#status_id', function () {
        $('.background-spinner').fadeIn();
        var selectedOption = $(this).find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        var dataId = selectedOption.data('id');
        var dataArrayVal = selectedOption.val();
        var landPage = getCookie('ncp_is_page');
        if (landPage === 'dashboard'){
            dashboardAjaxLoader(dataArrayId,dataId)
        }else if (landPage === 'request'){
            stateLoader(dataArrayId,function (){
                $('#request-account').val(dataArrayVal).trigger('change');
            })
        }else if (landPage === 'challenge'){
            stateLoader(dataArrayId,function (){
                $('.background-spinner').fadeOut();
            })
        }else if (landPage === 'withdrawal'){
            stateLoader(dataArrayId , function (){
                $('#ncp-withdrawal').trigger('click')
            });
        }else if (landPage === 'authentication'){
            stateLoader(dataArrayId,function (){
                $('.background-spinner').fadeOut();
            });
        }else if (landPage === 'profile'){
            stateLoader(dataArrayId,function (){
                $('.background-spinner').fadeOut();
            });
        }else if (landPage === 'support'){
            stateLoader(dataArrayId,function (){
                $('.background-spinner').fadeOut();
            });
        }else{
            stateLoader(dataArrayId,function (){
                $('.background-spinner').fadeOut();
            });
        }
    })
    $(document).on('change', '#request-account', function () {
        $('.background-spinner').fadeIn();
        var selectedOption = $(this).find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        var dataArrayVal = selectedOption.val();
        stateLoader(dataArrayId , function (){
            $('#status_id ').val(dataArrayVal).select();
        });
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_request_list',
                nonce: nonce,
                dataArrayId: dataArrayId,
                dataArrayVal: dataArrayVal,
            },
            success: function (response) {
                $('.ncp-request-list').html(response.listHTML);
                $('.background-spinner').fadeOut();
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            }
        })
    })
    $(document).on('change', '#withdrawal-type', function () {
        $('.background-spinner').fadeIn();
        var selectedOption = $(this).find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        var dataArrayVal = selectedOption.val();
        $('#status_id ').val(dataArrayVal).select();
        stateLoader(dataArrayId , function (){
            $('#ncp-withdrawal').trigger('click')
        });
    })


    function dashboardAjaxLoader(dataArrayId,dataId,val=0) {
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_dashboard_loader',
                nitro_access_token: nitro_access_token,
                nonce: nonce,
                dataArrayId: dataArrayId,
                dataId:dataId,
            },
            success: function (response) {
                $('#ncp-my-account-wrapper').html(response.template);
                $('#account-condition').html(response.step)
                // $('.btn-account-code').find('option:first').prop('selected', true);
                $('.background-spinner').fadeOut();
                $('.ncp-menu-content .menu-pointer').fadeOut();
                $('#ncp-dashboard .menu-pointer').fadeIn();
                history.pushState(null, '', '?land=dashboard');
                setCookie('ncp_is_page', 'dashboard', 7);
                if (val){
                    reloadRequest = setInterval(sendRequest, 20000);
                }
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            }
        })
    }
    
    function dashboardAjaxReloader(dataArrayId,dataId) {
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_dashboard_loader',
                nitro_access_token: nitro_access_token,
                nonce: nonce,
                dataArrayId: dataArrayId,
                dataId:dataId,
            },
            success: function (response) {
                $('#dashboard-content').html(response.template);
                $('#account-condition').html(response.step)
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            }
        })
    }

    function stateLoader(dataArrayId,callBack = null) {
        var selectedOption = $('#status_id ').find('option:selected');
        var dataId = selectedOption.data('id');
        $.ajax({
            url: ajax_filter_params.ajax_url,
            type: 'POST',
            data: {
                action: 'ncp_state_loader',
                nonce: nonce,
                dataArrayId: dataArrayId,
                dataId:dataId,
            },
            success: function (response) {
                $('#account-condition').html(response.step)
            },
            error: function (error) {
                console.error("Error occurred:", error);
                showToast(error.statusText, 'error');
                $('.background-spinner').fadeOut();
            },
            complete: function (){
                callBack();
                clearInterval(reloadRequest);
            }
        })
    }
    const actions = {
        'dashboard': function(dataArrayId) {
            dashboardAjaxLoader(dataArrayId,dataId);
        },
        'request': function(dataArrayId, dataArrayVal) {
            stateLoader(dataArrayId);
            $('#request-account').val(dataArrayVal).trigger('change');
        },
        'challenge': function(dataArrayId) {
            stateLoader(dataArrayId);
        },
        'withdrawal': function(dataArrayId) {
            stateLoader(dataArrayId);
            $('#ncp-withdrawal').trigger('click');
        },
        'authentication': function(dataArrayId) {
            stateLoader(dataArrayId);
            $('.background-spinner').fadeOut();
        },
        'profile': function(dataArrayId) {
            stateLoader(dataArrayId);
            $('.background-spinner').fadeOut();
        },
        'support': function(dataArrayId) {
            stateLoader(dataArrayId);
            $('.background-spinner').fadeOut();
        },
        'default': function(dataArrayId) {
            stateLoader(dataArrayId);
            $('.background-spinner').fadeOut();
        }
    };
    function sendRequest() {
        var selectedOption = $('#status_id').find('option:selected');
        var dataArrayId = selectedOption.data('array-id');
        var dataId = selectedOption.data('id');
        dashboardAjaxReloader(dataArrayId,dataId);
    }

    if (land === 'dashboard') {
        $('.ncp-menu-content .menu-pointer').fadeOut();
        $('#ncp-dashboard .menu-pointer').fadeIn();
        reloadRequest = setInterval(sendRequest, 20000);
    }
});

function addThousandsSeparator(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function showValidationErrors(errors) {
    let errorMessages = errors.slice(0, 3);
    errorMessages.forEach(error => {
        showToast(error, "error");
    });
}

function showToast(message, type) {
    Toastify({
        text: message, // Prepend the icon to the message
        duration: 3000,
        closeButton: false, // Disable close button
        gravity: "top",
        position: "right",
        newWindow: true,
        stopOnFocus: true,
        style: {
            background: type === 'success'
                ? "green"
                : "red",
            direction: "rtl",
            color:"#fff",
            borderRadius: "14px",
            minWidth: "150px",
            boxShadow: "0 3px 6px rgba(0,0,0,0.1)",
            fontFamily: "kalameh, sans-serif",
            fontSize: "16px",
            textAlign: "center",
        }
    }).showToast();
}

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

function table_loader(){
    jQuery(function ($){
        let currentStep = 1;
        $(document).on('click', '.btn-table', function (e) {
            e.preventDefault();
            $('.btn-table').removeClass('btn-active');
            $(this).addClass('btn-active');
        })
    
        function addThousandsSeparator(num) {
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    
        function updatePrice(newPrice, price) {
            var $targetPrice = $('#payment-cell a');
            $targetPrice.text(newPrice);
            if (price){
                $("#rial-price").text(addThousandsSeparator(price));
                $("#dollar-price").text(newPrice);
                $("#discount-code").val('').prop('disabled', false);
            }
        }
    
        $(document).on('click', '#btn-price-0', function (e) {
            e.preventDefault();
            updatePrice('$59 خرید', '59000');
        })
    
        $(document).on('click', '#btn-price-1', function (e) {
            e.preventDefault();
            updatePrice('$86 خرید', '86000');
        })
    
        $(document).on('click', '#btn-price-2', function (e) {
            e.preventDefault();
            updatePrice('$159 خرید', '159000');
        })
    
        $(document).on('click', '#btn-price-3', function (e) {
            e.preventDefault();
            updatePrice('$289 خرید', '289000');
        })
    
        function hideColumn() {
            if ($(window).width() < 768) {
                showStep(currentStep);
                $('#btn-next , #btn-priv').show();
            } else {
                $('.ncp-table th:nth-child(3), .ncp-table td:nth-child(3)').show();
                $('.ncp-table th:nth-child(4), .ncp-table td:nth-child(4)').show();
                $('#btn-next-one').hide();
            }
        }
    
        hideColumn();
        $(window).resize(function() {
            hideColumn();
        });
    
        function showStep(step) {
            $('th, td').hide(); // مخفی کردن همه ستون‌ها
            $('th:nth-child(1), td:nth-child(1)').show(); // نمایش ستون اول (چالش ها)
            $('th:nth-child(' + (step + 1) + '), td:nth-child(' + (step + 1) + ')').show(); // نمایش ستون فعلی
        }
    
        $(document).on('click', '#btn-next', function (e){
            e.preventDefault();
            if (currentStep < 3) {
                currentStep++;
                showStep(currentStep);
            }
        })
    
        $(document).on('click', '#btn-priv', function (e){
            e.preventDefault();
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        })
    })
    

}
