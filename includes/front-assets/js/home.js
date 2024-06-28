jQuery(function ($) {
    $(document).ready(function ($) {
        var nonce = ajax_filter_params.nonce;
        var site_url = ajax_filter_params.siteUrl;
        $('#ncp-exit').on('click', function () {
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
        $('.npc-exit-profile').on('click', function () {
            $.ajax({
                url: ajax_filter_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'ncp_exit',
                    nonce: nonce,
                },
                success: function (response) {
                    console.log(response)
                    window.location.href = site_url;
                },
                error: function (error) {
                    console.error("Error occurred:", error);
                }
            })
        })
        $(document).on('click', '.accordion-ncp-btn', function (e){
            e.preventDefault();
            let button = $(this);
            let panel = button.next('.panel');
            let svgIcon = button.find('.svg-icon');
            if (panel.hasClass('show')) {
                panel.css('max-height', panel.prop('scrollHeight') + 24 + 'px');
                requestAnimationFrame(() => {
                    panel.css('max-height', '0');
                    setTimeout(function() {
                        panel.removeClass('show');
                        button.removeClass('toggled');
                        svgIcon.toggleClass('rotated');
                    }, 300);
                });
            } else {
                setTimeout(function() {
                    panel.addClass('show');
                    requestAnimationFrame(() => {
                        panel.css('max-height', panel.prop('scrollHeight') + 24 + 'px');
                    });
                }, 300);
                button.addClass('toggled');
                svgIcon.toggleClass('rotated');
            }
        })
    });

})

//Blog Swiper JS

var swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 220,
    autoHeight: true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        // اندازه desktop
        1200: {
            slidesPerView: 3,
        },
        // اندازه tablet
        768: {
            slidesPerView: 3,
            spaceBetween: 90,
        },
        // اندازه mobile
        480: {
            slidesPerView: 2,
            spaceBetween: 19,
        },
        0: {
            slidesPerView: 2,
            spaceBetween: 19,
        },
    },
});


function toggleAccordion(id) {
    var accordion = document.getElementById(id);
    accordion.classList.toggle('show-content');
}
document.addEventListener("DOMContentLoaded", function() {
    // بررسی آدرس URL
    if (window.location.href.includes("support")) {
        // انتخاب عناصر با کلاس .elementor-location-footer
        var footerElements = document.querySelectorAll('.elementor-location-footer');
        // مخفی کردن هر عنصر
        footerElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }
});

