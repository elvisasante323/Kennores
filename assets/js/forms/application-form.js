$(document).ready(function() {

    // Validation rules
    $("#application-form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                validName: true
            },
            email: {
                required: true,
                email: true,
                validEmail: true
            },
            phone: {
                required: true,
                ukPhoneNumber: true,
            },
            message: {
                required: true,
                minlength: 30,
                validNameWithSpecialChars: true
            },
            file: {
                required: true,
                validFileExtension: "pdf"
            }
        },
        messages: {
            name: {
                required: "Name cannot be empty",
                minlength: "Name must be at least 3 characters"
            },
            email: {
                required: "Email cannot be empty",
                email: "Please enter a valid email address"
            },
            phone: {
                required: "Phone number cannot be empty",
                ukPhoneNumber: "Please enter a valid UK numbers"
            },
            message: {
                required: "Message cannot be empty",
                message: "Please enter a meaningful message"
            },
            file: {
                required: "Upload your CV"
            }
        }
    });

    // When Apply button is clicked
    $("#apply").click(function(){
        $("#apply").html("Application Sent !");
        $("#apply").prop("disabled", true);

        // Trigger an error alert when form validation fails
        if ( $("#application-form").valid() === false) {

            Swal.fire({
                title: 'Unable to submit form !',
                text: "Correct form errors to continue" ,
                icon: 'error',
                confirmButtonText: 'Okay',
                confirmButtonColor: "#19ce67"
            });

            return false;
        }

        // Submit forms via ajax
        let formData = new FormData( $("#application-form")[0]);

        // Send the form data using Ajax
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    title: response.message,
                    text: "We will get back to you as soon as possible." ,
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#19ce67"
                });

                $("#application-form")[0].reset();
            },
            error: function() {
                Swal.fire({
                    title: 'Unable to submit form!',
                    text: "Please call us." ,
                    icon: 'error',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#19ce67"
                });
            }
        });
    });
});
