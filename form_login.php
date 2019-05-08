<?php
require('includes/header.php');
require_once('includes/functions.php');

?> 


        <div class="modal fade" id="logIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">


        <!-- <button  type="button"  id="bSignUp" class="btn btn-light btn-rounden z-depth-1a" data-toggle="modal" data-target="#signUp">
        Sign Up
        </button> -->

        <button id="bSignUp" class="btn btn-light btn-rounden z-depth-1a">Sign Up</button>

        
        <div class="modal-dialog" role="document">
            <!--Content-->
        
            <div class="modal-content form-elegant">
                <center>
                    <div id="logo">
                        <img alt="logo" class="flogo" src="images/pinterest_logo.png">
                    </div>  
                    
                    <div id="title">
                        <h3><strong>Welcome to Pinterest</strong></h3>
                        <p>Find new ideas to try</p>
                    </div>
                </center>

                <!--Form-->
                <form action="login.php" method"POST">
                <div class="form">
                        <!--Inputs-->
                        <div class="mb-2">
                            <!-- Email: -->
                            <input type="text" class="form-control validate" placeholder="Email or phone number" name="uname" required>

                            <!-- Password -->
                            <input type="password" class="form-control validate" placeholder="Create a password" name="psw"  
                            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase
                            and lowercase letter, and at least 8 or more characters" required>

                            <!-- continue button -->
                            <button type="submit" class="btn btn-danger btn-rounden">Log in</button>
                        </div>
                    </form> 
                        
                    <p id="or">OR</p> 
                    <!--Facebook-->
                    <button type="button" class="btn btn-primary btn-rounded z-depth-1a">Continue with Facebook</button>          
                    <!--Google-->
                    <button type="button" class="google btn btn-rounded z-depth-1a">Continue with Google</button>

                    <div class="sub1">
                        By continuing, you agree to Pinterest's
                        <a href="https://policy.pinterest.com/en/terms-of-service">Terms of Service</a>
                        <a href="https://policy.pinterest.com/en/privacy-policy">Privacy Policy</a>
                    </div>

                    <div class="sub2">
                    <a>Forgot your password?</a>

                    </div>

                
            </div>

                    <div class="footer">
                        <a href="signup.php">Not on Pinterest yet? Sign Up</a>
                    </div>

            
            </div>


        </div>
        </div>
