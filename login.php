<?php
session_start();
include 'config.php';
if(isset($_POST['submit']))
{

// Define variables and initialize with empty values
$username = $password = "";
$invalid_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){    
    
    // if username is not empty
    if(!empty(trim($_POST["txtemail"]))){
        $username = trim($_POST["txtemail"]);
    }
    else
   {
    $error="<div class='text-danger'>Enter email</div>";	
   }
    // if password is not empty
    if(!empty(trim($_POST["txtpassword"]))){
        $password = trim($_POST["txtpassword"]);
       
    }
    else
    {
     $error1="<div class='text-danger'>Enter password</div>";	
    }
    

    // Validate credentials
    if(empty($invalid_err)){
    // SQL query to fetch information of registerd users and finds user match.
    $stmt = $conn->prepare("SELECT * FROM user WHERE UserEmail =? ");     
    $stmt->execute(array($username));
    $r=$stmt->fetch(PDO::FETCH_ASSOC);

    if($r == false){        
        $error="<div class='text-danger'>User $username not found.</div>";	
    }   

    else {
        if(password_verify($password, $r['UserPassword']))
        {
                $role_level=$r['UserRole'];
                $_SESSION['useremail']=$r['UserEmail'];
                $_SESSION['username']=$r['UserName'];
                $_SESSION['userid']=$r['UserId'];        
                $_SESSION['faculty']=$r['FacultyID'];        
                $_SESSION['role_level']=$role_level;
                
                if ($role_level=='guest'){
                    header("Location: guest.php");
                    }
                else if($role_level=='student'){
                    header("Location: student_upload.php");
                    }           
                else if($role_level=='coordinator'){
                    header("Location: coordinator.php");
                    }
                else if($role_level=='marketingmanager'){
                    header("Location: manager.php");
                    }
                else if($role_level=='admin'){
                        header("Location: admin.php");
                    }
   
        }
        else {$invalid_err="<div class='text-danger'><center>Wrong Password</center></div>";}
       
    }
   
   
      
    }
    
    
}




}






?>

<html class="no-js" lang="en">
<?php include "header_design.php"; ?>
 <title>Sign In</title>

<body>
 
    <!-- preloader area start -->
    <div id="preloader">
      
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
        
            <div class="login-box ptb--100 ">
                <form action="login.php" method="post" enctype = "multipart/form-data">
             
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Admin Template</p>
                    </div>
                    <span><?php 	if(isset($invalid_err)){
                    echo $invalid_err;                   
				}?></span>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="exampleInputEmail1" name="txtemail">
                            <i class="ti-email"></i>
                            <span><?php 	
                            if(isset($error)){
                           echo $error;                   
                            }?>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="exampleInputPassword1" name="txtpassword"> 
                            <i class="ti-lock"></i>
                            <?php 	
                            if(isset($error1)){
                           echo $error1;                   
                            }?>
                        </div>
                        <!-- <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                    <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="#">Forgot Password?</a>
                            </div>
                        </div> -->
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit" name="submit">Submit <i class="ti-arrow-right"></i></button>
                            
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="register.php">Sign up</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
    
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>