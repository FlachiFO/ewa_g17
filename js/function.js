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
            , url: './admin/login_process.php'
            , data: data
            , beforeSend: function () {
                $("#error").fadeOut();
                //				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            }
            , success: function (response) {
                if (response == "ok") {
                    $("#btn-login").html('<img class="load_img" src="./img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    //						setTimeout(' window.location.href = "./home.php"; ',4000);
                    window.location.href = "./index.php";
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
            , url: './admin/regist_process.php'
            , data: data
            , beforeSend: function () {
                $("#error").fadeOut();
                //				$("#btn-login").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; sending ...');
            }
            , success: function (response) {
                if (response == "ok") {
                    //                    $("#btn-regist").html('<img class="load_img" src="./img/btn-ajax-loader.gif" /> &nbsp; Signing In ...');
                    $("#error2").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Registrierung erfolgreich!</div>');
                    setTimeout(' window.location.href = "./index.php"; ', 4000);
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
    
    
});

function del_user_alert() {
    confirm('User entfernen');
    del_user();
};
function del_user() {
    $.ajax({url: "./admin/delete_user.php"}).done(function () {window.location.href = "./index.php";});
};































