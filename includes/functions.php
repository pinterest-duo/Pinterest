<script>
    $(document).ready(function(){     
    $('#signUp').modal();
    $("#bSignUp").click(function() {
        $("#signUp").modal("show", function() {
            $("#logIn").modal("hide");
        });
    });

    $("#blogin").click(function() {
        $("#logIn").modal("show", function() {
            $("#signUp").modal("hide");
        });
    });
    
    }); 
</script> 