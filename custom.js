jQuery(document).ready(function ($) {
    $(document).on('submit', '#api-form', function (e) {
        e.preventDefault();
        var formData = [];
        var name = $(this).find('#name').val();
        var email = $(this).find('#email').val();
        var gender = $(this).find('input[name="gender"]:checked').val();
        var subjects = [];
        $(this).find('input[type="checkbox"]:checked').each(function () {
            subjects.push($(this).val());
        });

        if (subjects.length <= 0) {
            $('small.subject-message').css('color', 'red');
            return;
        } else {
            $('small.subject-message').css('color', '');
        }

        var message = $(this).find('#message').val();
        formData.push({
            name: name,
            email: email,
            gender: gender,
            subjects: subjects,
            message: message
        });

        $.ajax({
            url: 'receive-request.php',
            type: 'POST',
            data: { formData: formData },
            success: function (response) {
                var insertResponse = JSON.parse(response.insert_response);
                if (insertResponse.status == true) {
                    $('.response-message').html('<span style="color:green;">' + insertResponse.message + '</span>');
                } else {
                    $('.response-message').html('<span style="color:red;">' + insertResponse.message + '</span>');
                }

                var retrieveResponse = response.retrieve_response;
                $('table tbody').html(retrieveResponse);

                $('#api-form').trigger('reset');
                console.log('Data sent successfully:', response);
            },
            error: function (xhr, status, error) {
                console.error('Error sending data:', error);
            }
        });
    });
});
