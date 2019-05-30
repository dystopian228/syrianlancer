$(document).ready(function(){
    

    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');           
            $('#show_hide_password SVG').attr('data-icon','eye');
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password SVG').attr('data-icon','eye-slash');
        }
    });


    $('#sandbox-container input').datepicker({            uiLibrary: 'bootstrap4'
});
});