/**
* Theme: Ubold Admin Template
* Author: Coderthemes
* Form wizard page
*/

!function($) {
    "use strict";

    var FormWizard = function() {};

    function myFunction() {
        console.log('run my script');
        //console.log($('#name').val());
        $('#result-name').text(' ' + $('#name').val() + ' ');
        $('#result-gender').text(' ' + $('#gender').val() + ' ');
        $('#result-dob').text(' ' + $('#dob').val() + ' ');
        $('#result-cmnd').text(' ' + $('#cmnd').val() + ' ');
        $('#result-phone').text(' ' + $('#phone').val() + ' ');
        $('#result-address').text(' ' + $('#address').val() + ' ');
    };

    //creates form with validation
    FormWizard.prototype.createValidatorForm = function($form_container) {
        $form_container.validate({
            errorPlacement: function errorPlacement(error, element) {
                element.after(error);
            }
        });
        $form_container.children("div").steps({
            headerTag: "h3",
            bodyTag: "section",
            transitionEffect: "slideLeft",
            onStepChanging: function (event, currentIndex, newIndex) {
                $form_container.validate().settings.ignore = ":disabled,:hidden";
                myFunction();
                return $form_container.valid();
            },
            onFinishing: function (event, currentIndex) {
                $form_container.validate().settings.ignore = ":disabled";
                return $form_container.valid();
            },
            onFinished: function (event, currentIndex) {
                $("#wizard-validation-form").submit();
            }
        });

        return $form_container;
    },

    FormWizard.prototype.init = function() {
        //initialzing various forms

        //basic form
        // this.createBasic($("#basic-form"));

        //form with validation
        this.createValidatorForm($("#wizard-validation-form"));

        //vertical form
        // this.createVertical($("#wizard-vertical"));
    },
    //init
    $.FormWizard = new FormWizard, $.FormWizard.Constructor = FormWizard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.FormWizard.init()
}(window.jQuery);