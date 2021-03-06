/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';
// global.$ = $;


$("#generate_number").on("submit", function(e){
    e.preventDefault();         //Prevent Default action.

    let form = this;
    let formURL = this.action;

    $.ajax({
        url:     formURL,
        type:    'post',
        data:    $(form).serialize(),
        success: function(data, textStatus, jqXHR)
        {
            $('#generate_number span').html(data.id);
            $('#generate_number b').html(data.number);
        },
        error:   function(jqXHR, textStatus, errorThrown)
        {
            alert("Что-то пошло не так...");
        }
    });

});

$("#get_generated_number").on("submit", function(e){
    e.preventDefault();         //Prevent Default action.

    let form = this;
    let formURL = this.action + form.number_id.value;

    $.ajax({
        url:     formURL,
        type:    'post',
        data:    $(form).serialize(),
        success: function(data, textStatus, jqXHR)
        {
            $('#get_generated_number span').html(data.id);
            $('#get_generated_number b').html(data.number);
        },
        error:   function(jqXHR, textStatus, errorThrown)
        {
            alert("Что-то пошло не так...");
        }
    });

});

$("#signup").click(function() {
    $("#first").fadeOut("fast", function() {
        $("#second").fadeIn("fast");
    });
});

$("#signin").click(function() {
    $("#second").fadeOut("fast", function() {
        $("#first").fadeIn("fast");
    });
});



$(function() {
    $("form[name='login']").validate({
        rules: {

            email: {
                required: true,
                email: true
            },
            password: {
                required: true,

            }
        },
        messages: {
            email: "Please enter a valid email address",

            password: {
                required: "Please enter password",

            }

        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});



$(function() {

    $("form[name='registration']").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },

        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            email: "Please enter a valid email address"
        },

        submitHandler: function(form) {
            form.submit();
        }
    });
});