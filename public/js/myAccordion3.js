$(document).ready(function() {
    $('.acc_container').hide();

    $('.acc_red').click(function() {
        if ($(this).next().is(':hidden')) {
            $('.acc_red').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        } else {
            $('.acc_red').removeClass('active').next().slideUp();
        }
        return false;
    });

    $('.acc_yellow').click(function() {
        if ($(this).next().is(':hidden')) {
            $('.acc_yellow').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        } else {
            $('.acc_yellow').removeClass('active').next().slideUp();
        }
        return false;
    });

    $('.acc_green').click(function() {
        if ($(this).next().is(':hidden')) {
            $('.acc_green').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        } else {
            $('.acc_green').removeClass('active').next().slideUp();
        }
        return false;
    });

    $('.acc_purple').click(function() {
        if ($(this).next().is(':hidden')) {
            $('.acc_purple').removeClass('active').next().slideUp();
            $(this).toggleClass('active').next().slideDown();
        } else {
            $('.acc_purple').removeClass('active').next().slideUp();
        }
        return false;
    });
}); 