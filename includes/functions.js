$(document).ready(function(){     
    $('#signUp').modal();
    $("#bSignUp").click(function() {
        $("#signUp").modal("show");
        $("#logIn").modal("hide");
    });

    $("#blogin").click(function() {
        $("#logIn").modal("show");
        $("#signUp").modal("hide");
    });
}); 