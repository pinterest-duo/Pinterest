
<script>
$(document).ready(function(){        
   $('#signUp').modal('show');
    }); 

    
</script>


<!-- Modal -->
<div class="modal fade" id="signUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <button id="blogin" class="btn btn-light btn-rounden z-depth-1a" onclick= >Log in</button>

 
  <div class="modal-dialog" role="document">
    <!--Content-->
  
    <div class="modal-content form-elegant">
        <center>
            <div id="logo">
                <img class="flogo" src="pinterest_logo.png">
            </div> 
            
            <div id="title">
                <h3><strong>Welcome to Pinterest</strong></h3>
                <p>Find new ideas to try</p>
            </div>
        </center>

        <!--Form-->
        <form action="" method"">
            <div class="form">
                <!--Inputs-->
                <div class="mb-2">
                    <!-- Email: -->
                    <input type="email" class="form-control validate" placeholder="Email" name="uname" required>

                    <!-- Password -->
                    <input type="password" class="form-control validate" placeholder="Create a password" name="psw"  
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase
                     and lowercase letter, and at least 8 or more characters" required>

                     <!-- Age -->
                    <input type="text" class="form-control validate" placeholder="Age" name="age" pattern="\d*" required
                    title="Must be a number">

                    <!-- continue button -->
                    <button type="submit" class="btn btn-danger btn-rounden">Continue</button>
                </div>
            </form> 
                
            <p id="or">OR</p> 
            <!--Facebook-->
            <button type="button" class="btn btn-primary btn-rounded z-depth-1a">Continue with Facebook</button>          
            <!--Google-->
            <button type="button" id="google" class="btn btn-rounded z-depth-1a">Continue with Google</button>

            <div class="sub1">
                By continuing, you agree to Pinterest's
                <a href="https://policy.pinterest.com/en/terms-of-service">Terms of Service</a>
                <a href="https://policy.pinterest.com/en/privacy-policy">Privacy Policy</a>
            </div>

            <div class="sub2">
               <a href="login.php" > Already a member? Log in </a>

            </div>

        
      </div>

             <div class="footer">
                Create a business account
            </div>

     
    </div>


  </div>
</div>

