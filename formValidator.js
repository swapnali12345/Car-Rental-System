
$(document).ready(function() {

    $("#contact_form")
        .bootstrapValidator({
            feedbackIcons: {
                valid: "glyphicon glyphicon-ok",
                invalid: "glyphicon glyphicon-remove",
                validating: "glyphicon glyphicon-refresh"
            },
            fields: {
                first_name: {
                    validators: {
                        stringLength: {
                            min: 2
                        },
                        notEmpty: {
                            message: "Please give your first name"
                        }
                    }
                },
                last_name: {
                    validators: {
                        stringLength: {
                            min: 1
                        },
                        notEmpty: {
                            message: "Please give your last name"
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: "Please give your email address"
                        },
                        emailAddress: {
                            message: "Please give a valid email address"
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "Please give your phone number"
                        },
                        phone: {
                            country: "US",
                            message: "Please give a vaild phone number without country code"
                        }
                    }
                },
                address: {
                    validators: {
                        stringLength: {
                            min: 8
                        },
                        notEmpty: {
                            message: "Please give your street address"
                        }
                    }
                },
                city: {
                    validators: {
                        stringLength: {
                            min: 4
                        },
                        notEmpty: {
                            message: "Please give your city"
                        }
                    }
                },
                state: {
                    validators: {
                        notEmpty: {
                            message: "Please select your state"
                        }
                    }
                },
                zip: {
                    validators: {
                        notEmpty: {
                            message: "Please give your zip code"
                        },
                        zipCode: {
                            country: "US",
                            message: "Please give a vaild zip code"
                        }
                    }
                },
                comment: {
                    validators: {
                        stringLength: {
                            min: 10,
                            max: 200,
                            message: "Please enter at least 10 characters and not more than 200"
                        },
                        notEmpty: {
                            message: "Please give a description of your project"
                        }
                    }
                }
            }
        })
        .on("success.form.bv", function(e) {
            $("#success_message").slideDown({ opacity: "show" }, "slow");
            $("#contact_form").data("bootstrapValidator").resetForm();

            e.preventDefault();

            var $form = $(e.target);

            var bv = $form.data("bootstrapValidator");

            $.post(
                $form.attr("action"),
                $form.serialize(),
                function(result) {
                    console.log(result);
                },
                "json"
            );
        });
});

