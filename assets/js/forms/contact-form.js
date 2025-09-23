$(document).ready(function() {

    // Validation rules
    $("#contact-form").validate({
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
            subject: {
                required: true,
                minlength: 5,
                validNameWithSpecialChars: true

            },
            message: {
                required: true,
                minlength: 30,
                validNameWithSpecialChars: true
            },
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
            subject: {
                required: "Subject cannot be empty",
                subject: "Please enter a meaningful subject"
            },
            message: {
                required: "Message cannot be empty",
                message: "Please enter a meaningful message"
            }
        }
    });

    // When Send Message button is clicked
    $("#sendMessage").click(function(){

        // Trigger an error alert when form validation fails
        if ( $("#contact-form").valid() === false) {

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
        let formData = $("#contact-form").serialize();

        // Send the form data using Ajax
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            success: function(response) {
                Swal.fire({
                    title: response.message,
                    text: "We will get back to you as soon as possible." ,
                    icon: 'success',
                    confirmButtonText: 'Okay',
                    confirmButtonColor: "#19ce67"
                });

                $("#contact-form")[0].reset();
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
