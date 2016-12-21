$('document').ready(function () {
    /* validation */
    $("#login-form").validate({
        rules: {
            password: {
                required: true
            , }
            //            , user_email: {
            //                required: true
            //                , user_name: true
            //            }
            
        , }
        , messages: {
            password: {
                required: "please enter your password"
            }
            , user: "please enter your username"
        , }
        , submitHandler: submitForm
    });
    /* validation */
    /* login submit */
    function submitForm() {
        var data = $("#login-form").serialize();
        $.ajax({
            type: 'POST'
            , url: './config/login_process.php'
            , data: data
            , beforeSend: function () {
                $("#error").fadeOut();
                //				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            }
            , success: function (response) {
                if (response == "ok") {
                    $("#btn-login").html('<img class="load_img" src="./img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    //						setTimeout(' window.location.href = "./home.php"; ',4000);
                    window.location.href = "./home.php";
                }
                else {
                    $("#error").fadeIn(1000, function () {
                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                        //                        $("#btn-login").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                }
            }
        });
        return false;
    }
    $("#register-form").validate({
        rules: {
            password: {
                required: true
            , }
            //            , user_email: {
            //                required: true
            //                , user_name: true
            //            }
            
        , }
        , messages: {
            password: {
                required: "please enter your password"
            }
            , user: "please enter your username"
        , }
        , submitHandler: submitForm2
    });
    /* validation */
    /* login submit */
    function submitForm2() {
        var data = $("#register-form").serialize();
        $.ajax({
            type: 'POST'
            , url: './config/regist_process.php'
            , data: data
            , beforeSend: function () {
                $("#error").fadeOut();
                //				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            }
            , success: function (response) {
                if (response == "ok") {
                    //                    $("#btn-regist").html('<img class="load_img" src="./img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    $("#error2").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Registrierung erfolgreich!</div>');
                    setTimeout(' window.location.href = "./home.php"; ', 4000);
                    //                    window.location.href = "./home.php";
                }
                else {
                    $("#error2").fadeIn(1000, function () {
                        $("#error2").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; ' + response + ' !</div>');
                        //                        $("#btn-regist").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In');
                    });
                }
            }
        });
        return false;
    }
    $(".del_user").click(function () {
        swal({
            title: "Sind Sie Sicher?"
            , text: "Benutzer wird dauerhaft gelöscht!"
            , type: "warning"
            , showCancelButton: true
            , confirmButtonClass: "btn-danger"
            , confirmButtonText: "Ja, löschen"
            , closeOnConfirm: false
        }, function () {
            swal("gelöscht!", "Sie werden nun auf die Startseite weitergeleitet.", "success");
            setTimeout('$.ajax({url: "./config/delete_user.php"}).done(function () {window.location.href = "./home.php";});', 2500);
        });
    });
//    $(".confirm").click(function() {
//        $.ajax({url: "./config/delete_user.php"}).done(function () {window.location.href = "./home.php";});
//    });
});