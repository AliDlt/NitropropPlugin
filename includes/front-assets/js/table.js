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
