$(document).ready(function(){

    $('.ajax-form').on('submit', function(e){
        e.preventDefault();

        var formData     = new FormData($(this)[0]);
        var formAction   = $(this).attr('action');
        var formMethod   = $(this).attr('method');
        var formRedirect = $(this).attr('data-redirect');
        var formAjax     = $(this).attr('data-ajax');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: formAction,
            method: formMethod,
            datatType: 'json',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () 
            {
            	$('.loader').fadeIn(500);
                $('.ajax-form input, .ajax-form textarea, .ajax-form button[type="submit"]').attr('disabled', 'disabled');
            },
            success: function (data)
            {
            	$('.loader').fadeOut(500);
                $('.ajax-form input, .ajax-form textarea, .ajax-form button[type="submit"]').removeAttr('disabled');

                if (formRedirect == 'done') {                   
                    // Reset form inputs
                    $('.reset').val('');
                    $('.myfile_name').html('');

                    // Done alert
					new RetroNotify({
					    contentText: 'data has been successfully saved.',
					    contentHeader: 'DONE',
					    closeDelay: 10000,
					    style: 'green',
					})
                } else if (formRedirect == 'update') {
                    // Update alert
					new RetroNotify({
					    contentText: 'data has been successfully updated.',
					    contentHeader: 'UPDATED',
					    closeDelay: 10000,
					    style: 'blue',
					})

                    $("input[type='file']").val('');
                } else if (formRedirect == 'delete') {
                    // Delete alert
					new RetroNotify({
					    contentText: 'data has been successfully deleted.',
					    contentHeader: 'DELETED',
					    closeDelay: 10000,
					    style: 'red',
					})

                    // Remove all rows with checked checkbox
                    $('.table-row').has('input[name="id[]"]:checked').remove();
                } else if(formRedirect == 'restore') {
                    //toast_alert();
                } else if(formRedirect == 'load') {
                    // Reload page
                    window.location.reload();
                } else if(formRedirect !== 'off') {
                    // Redirect page to specific url
                    window.location.href = formRedirect;
                }
            },
            error: function (dataError, exception)
            {
                $('.loader').fadeOut(500);
                $('.ajax-form input, .ajax-form textarea, button[type="submit"]').removeAttr('disabled');

                if(exception == 'error'){
                    var errors = dataError.responseJSON.errors;
                    console.log(errors);
                    $.each(errors, function(key, value){

	                    new RetroNotify({
						    contentText: value,
						    contentHeader: 'ERROR',
						    closeDelay: 10000,
						    style: 'red',
						})

                    });
                }
            },
        });

        return false;
    });

});