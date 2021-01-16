<?php

email: {
    validators: {
        notEmpty: {
            message: 'Please give your email address'
                                },
        emailAddress: {
            message: 'Please give a valid email address'
                                }
    }
},
phone: {
    validators: {
        notEmpty: {
            message: 'Please give your phone number'
                                },
        phone: {
            country: 'US',
                                    message: 'Please give a vaild phone number with area code'
                                }
    }
},
street: {
    validators: {
        stringLength: {
            min: 8,
                                },
        notEmpty: {
            message: 'Please give your street address'
                                }
    }
},
city: {
    validators: {
        stringLength: {
            min: 4,
                                },
        notEmpty: {
            message: 'Please give your city'
                                }
    }
},
state: {
    validators: {
        notEmpty: {
            message: 'Please select your state'
                                }
    }
},
zip: {
    validators: {
        notEmpty: {
            message: 'Please give your zip code'
                                },
        zipCode: {
            country: 'US',
                                    message: 'Please give a valid zip code'
                                }
    }
},
dob: {
    validators: {
        notEmpty: {
            message: 'Please give your birthdate'
                                },
        date: {
            message: 'Please enter in correct format'
                                }
    }
},
license: {
    validators: {
        notEmpty: {
            message: 'Please give your license number'
                                 }
    }
},
license_date: {
    validators: {
        notEmpty: {
            message: 'Please give your license issue date'
                                },
        date: {
            message: 'Please enter in correct format'
                                }
    }
},
pw: {
    validators: {
        stringLength: {
            min: 8,
                                    message: 'Your password needs to be at least 8 characters'
                                },
        notEmpty: {
            message: 'Please give a password for your account'
                                }
    }
}