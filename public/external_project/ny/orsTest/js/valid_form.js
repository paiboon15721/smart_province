
    
    jQuery(function($){
        $("#txt_pid").mask("9-9999-99999-99-9");
        
        $("#txt_age_start").mask("999");
        $("#txt_age_end").mask("999");
        $("#txt_dob_start").mask("99/99/9999");
        $("#txt_dob_end").mask("99/99/9999");
        $("#txt_datemi_start").mask("99/99/9999");
        $("#txt_datemi_end").mask("99/99/9999");
        
        $("#txt_hid").mask("9999-999999-9");
    });
    
    $("#frm_search_pop").validate({
        rules: {    
            txt_fname: {
                minlength: 2
            },
            txt_lname: {
                minlength: 2
            }
        },
        messages: {
            txt_fname: {
                minlength: "ระบุชื่อตัวอย่างน้อย 2 ตัวอักษร"
            },
            txt_lname: {
                minlength: "ระบุชื่อสกุลอย่างน้อย 2 ตัวอักษร"
            }
        }
    });
    
    /*$("#frm_search_pop").validate({
        rules: {
            firstname: "required",
            lastname: "required",
            username: {
                required: true,
                minlength: 2
            },
            password: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email: true
            },
            topic: {
                required: "#newsletter:checked",
                minlength: 2
            },
            agree: "required"
        },
        messages: {
            firstname: "Please enter your firstname",
            lastname: "Please enter your lastname",
            username: {
                required: "Please enter a username",
                minlength: "Your username must consist of at least 2 characters"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            confirm_password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long",
                equalTo: "Please enter the same password as above"
            },
            email: "Please enter a valid email address",
            agree: "Please accept our policy"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function() {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if(firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function() {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });*/
