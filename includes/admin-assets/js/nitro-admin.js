jQuery(function ($) {
    $(document).on('click', '#auth_status_accept', function (e){
        var id = $(this).data('id');
        var data = {
            'action': 'update_auth_status',
            'id': id,
            'condition' : 2,
        };
        $.post(ajaxurl, data, function(response) {
            console.log('Server response: ' + response);
            location.reload();
            // Reload page or update UI as needed
        });
    })
    $(document).on('click', '#auth_status_reject', function (e){
        var id = $(this).data('id');
        var data = {
            'action': 'update_auth_status',
            'id': id,
            'condition' : 3,
        };
        $.post(ajaxurl, data, function(response) {
            console.log('Server response: ' + response);
            location.reload();
            // Reload page or update UI as needed
        });
    })
    $(document).on('click', '#auth_delete', function (e){
        var id = $(this).data('id');
        if (confirm('آیا مطمئن هستید که می‌خواهید پاک کنید؟')) {
            var data = {
                'action': 'delete_nitro_row_callback',
                'id': id,
                'condition' : 0,
            };
            $.post(ajaxurl, data, function(response) {
                console.log('Server response: ' + response);
                location.reload();
            });
        } else {
            console.log('عملیات لغو شد.');
        }
    });
})