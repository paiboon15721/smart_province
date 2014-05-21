$(document).ready(function(){
    $("#btn_print").click(function(){
       window.print();
    });
    $('#btn_close').click(function(){
        parent.$.fancybox.close();
    });
});