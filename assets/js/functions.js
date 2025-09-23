/**
 * An IIFE that grabs the values of
 * data target
 */
(function() {
    $("[data-target]").each(function(){

        $(this).click(function(){
            let section = $(this).data('target');
            window.scroller(section);
        });
    });
})();


/**
 *  Scrolls to a section without showing hash
 *  in URL
 */
window.scroller = function(section)
{
    document.querySelector('#' + section).scrollIntoView({ behavior: "smooth"});
}

/**
 * Uk Phone Number validation using jquery validation
 *  plugin
 */
$.validator.addMethod("ukPhoneNumber", function(phoneNumber, element) {
    phoneNumber = phoneNumber.replace(/\s+/g, "");
    return this.optional(element) || /^(\+44|0)\d{10}$/.test(phoneNumber);
}, "Please enter a valid UK phone number.");

/**
 * Name validation using jquery validation
 *  plugin
 */
$.validator.addMethod("validName", function(value, element) {
    const namePattern = /^[a-zA-Z\s]+$/;
    return this.optional(element) || namePattern.test(value);
}, "Please enter a valid name with only letters and spaces.");

/**
 * Email validation using jquery validation
 *  plugin
 */
$.validator.addMethod("validEmail", function(value, element) {
    const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return this.optional(element) || emailPattern.test(value);
}, "Please enter a valid email address.");

/**
 * Name validation with special characters using jquery validation
 *  plugin
 */
$.validator.addMethod("validNameWithSpecialChars", function(value, element) {
    // Define a regular expression for a valid name (letters, spaces, and special characters)
    const namePattern = /^[a-zA-Z\s@#$%^&*()_+|\-={}[\]:;<>?~!]+$/;
    return this.optional(element) || namePattern.test(value);
}, "Please enter a valid name with letters, spaces, or special characters.");

/**
 * File extension validation  using jquery validation
 *  plugin
 */
$.validator.addMethod("validFileExtension", function(value, element, extensions) {
    // Split the input value to get the file extension
    var fileExtension = value.split('.').pop().toLowerCase();

    // Check if the file extension is in the list of valid extensions
    return this.optional(element) || extensions.split(',').indexOf(fileExtension) !== -1;
}, "Please select a file with a valid extension.");