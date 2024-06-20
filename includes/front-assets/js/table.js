// jQuery(document).ready(function($) {
//     let currentTable = 1;
//     let currentColumn = 2;
//
//     function showTable(index) {
//         $('table[id^=table-]').hide();
//         $(`#table-${index}`).show();
//     }
//
//     // Initially show the first table
//     showTable(currentTable);
//
//     // Event listeners for the buttons
//     $(document).on('click', '[id^=btn-price-]', function (e) {
//         e.preventDefault();
//         const buttonId = $(this).attr('id');
//         $('.btn-table').removeClass('btn-active');
//         $(this).addClass('btn-active');
//
//         // Show the selected table
//         switch (buttonId) {
//             case 'btn-price-0':
//                 currentTable = 1;
//                 break;
//             case 'btn-price-1':
//                 currentTable = 2;
//                 break;
//             case 'btn-price-2':
//                 currentTable = 3;
//                 break;
//             case 'btn-price-3':
//                 currentTable = 4;
//                 break;
//         }
//         showTable(currentTable);
//     });
//
//     function showColumn(column) {
//         $('table tr th, table tr td').hide();
//         $('table tr th:first-child, table tr td:first-child').show();
//         $(`table tr th:nth-child(${column}), table tr td:nth-child(${column})`).show();
//     }
//
//     function updateButtons() {
//         $('.btn-prev').toggle(currentColumn > 2);
//         $('.btn-next').toggle(currentColumn < 4);
//     }
//
//     function handleResize() {
//         if ($(window).width() > 768) {
//             $('table tr th, table tr td').show();
//             $('.btn-next, .btn-prev').hide();
//         } else {
//             $('table tr th, table tr td').hide();
//             showColumn(currentColumn);
//             $('.btn-next, .btn-prev').show();
//             updateButtons();
//         }
//     }
//
//     // Trigger the resize handler initially
//     handleResize();
//
//     $(window).resize(function() {
//         handleResize();
//     });
//
//     $('.btn-next').click(function() {
//         if (currentColumn < 4) {
//             currentColumn++;
//             showColumn(currentColumn);
//             updateButtons();
//         }
//     });
//
//     $('.btn-prev').click(function() {
//         if (currentColumn > 2) {
//             currentColumn--;
//             showColumn(currentColumn);
//             updateButtons();
//         }
//     });
// });




jQuery(function ($){
    let currentStep = 1;
    $(document).on('click', '.btn-table', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
    })

    $(document).on('click', '#btn-price-0', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
        var $targetTd = $('tr td:first-child:contains("مدت زمان")').closest('tr').find('td:eq(1), td:eq(2)');
        $targetTd.text('30 روز');
        var $targetPrice = $('tr td:first-child:contains("هزینه یکبارپرداخت")').closest('tr').find('td:eq(1) a');
        $targetPrice.text('$59')
        let price = $('#price-one').val();
        if (price){
            $("#rial-price").text(addThousandsSeparator(price));
            $("#dollar-price").text('$59');
            $("#discount-code").val('').prop('disabled', false);
        }
    })
    $(document).on('click', '#btn-price-1', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
        var $targetTd = $('tr td:first-child:contains("مدت زمان")').closest('tr').find('td:eq(1), td:eq(2)');
        $targetTd.text('30 روز');
        var $targetPrice = $('tr td:first-child:contains("هزینه یکبارپرداخت")').closest('tr').find('td:eq(1) a');
        $targetPrice.text('$86')
        let price = $('#price-two').val();
        if (price){
            $("#rial-price").text(addThousandsSeparator(price));
            $("#dollar-price").text('$86');
            $("#discount-code").val('').prop('disabled', false);
        }
    })
    $(document).on('click', '#btn-price-2', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
        var $targetTd = $('tr td:first-child:contains("مدت زمان")').closest('tr').find('td:eq(1), td:eq(2)');
        $targetTd.text('120 روز');
        var $targetPrice = $('tr td:first-child:contains("هزینه یکبارپرداخت")').closest('tr').find('td:eq(1) a');
        $targetPrice.text('$159')
        let price = $('#price-three').val();
        if (price){
            $("#rial-price").text(addThousandsSeparator(price));
            $("#dollar-price").text('$159');
            $("#discount-code").val('').prop('disabled', false);
        }
    })
    $(document).on('click', '#btn-price-3', function (e) {
        e.preventDefault();
        $('.btn-table').removeClass('btn-active');
        $(this).addClass('btn-active');
        var $targetTd = $('tr td:first-child:contains("مدت زمان")').closest('tr').find('td:eq(1), td:eq(2)');
        $targetTd.text('120 روز');
        var $targetPrice = $('tr td:first-child:contains("هزینه یکبارپرداخت")').closest('tr').find('td:eq(1) a');
        $targetPrice.text('$289')
        let price = $('#price-fore').val();
        if (price){
            $("#rial-price").text(addThousandsSeparator(price));
            $("#dollar-price").text('$289');
            $("#discount-code").val('').prop('disabled', false);
        }
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