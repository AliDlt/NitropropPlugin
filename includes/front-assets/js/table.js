jQuery(function ($) {
    let currentStep = 1;

    $(document).ready(function() {
        $('#btn-price-1').trigger('click');
    });
    
    $(document).on('click', '.btn-table', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
    });

    function updateDiscountedPrice(newPrice) {
        var $targetPrice = $('#discounted-payment-cell a');
        $targetPrice.text(newPrice);
    }

    $(document).on('click', '#btn-price-0', function (e) {
        e.preventDefault();
        updatePrice('$59');
        updateDiscountedPrice('$42 خرید');
    });

    $(document).on('click', '#btn-price-1', function (e) {
        e.preventDefault();
        updatePrice('$86');
        updateDiscountedPrice('$68 خرید');
    });

    $(document).on('click', '#btn-price-2', function (e) {
        e.preventDefault();
        updatePrice('$159');
        updateDiscountedPrice('$129 خرید');
    });

    $(document).on('click', '#btn-price-3', function (e) {
        e.preventDefault();
        updatePrice('$289');
        updateDiscountedPrice('$239 خرید');
    });

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
    function updatePrice(newPrice) {
        var $targetPrice = $('#payment-cell a');
        $targetPrice.text(newPrice);
    }
    hideColumn();
    $(window).resize(function() {
        hideColumn();
    });

    function showStep(step) {
        $('th, td').hide(); // Hide all columns
        $('th:nth-child(1), td:nth-child(1)').show(); // Show first column (Challenges)
        $('th:nth-child(' + (step + 1) + '), td:nth-child(' + (step + 1) + ')').show(); // Show current column
    }

    $(document).on('click', '#btn-next', function (e) {
        e.preventDefault();
        if (currentStep < 3) {
            currentStep++;
            showStep(currentStep);
        }
    });

    $(document).on('click', '#btn-priv', function (e) {
        e.preventDefault();
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });
});
