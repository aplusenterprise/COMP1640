<?php
session_start();
include('config.php');
include 'include/function.php';
require "phpmailer/PHPMailerAutoload.php";

if(isset($_POST['submit']))
{
// Define variables and initialize with empty values
$username = $email = $password = $passwordrepeat = $faculty = $phone ="";
$invalid_err = "";

// Define variables 
$username = trim($_POST['username']); 
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$passwordrepeat = trim($_POST['password_repeat']);
$faculty = trim($_POST['faculty']); 
$phone = trim($_POST['phone']); 

$emailadd = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    
      
 if ($_POST['password'] !== $_POST['password_repeat']) {
    $invalid_err="<div class='text-danger'>Password and Confirm password should match!</div>";   
 }
 
 else if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
  $invalid_err="<div class='text-danger'>Only letters and white space allowed for Username!</div>";   
 
}

else if (!filter_var($emailadd, FILTER_VALIDATE_EMAIL)) {
  $invalid_err="<div class='text-danger'>Invalid email format!</div>"; 
  
}
else if(!preg_match("/^[0-9]{10}$ || ^[0-9]{11}$/" , $phone)) {
  $invalid_err="<div class='text-danger'>Invalid phone format!</div>";   
}
 else  
  {  

 // Validate credentials
 if(empty($invalid_err)){

    try{
        // SQL query to fetch information of registerd users and finds user match.
        $stmt = $conn->prepare("SELECT UserEmail FROM user WHERE UserEmail = :name");   
        //$stmt = $conn->prepare("SELECT * FROM user WHERE UserName = :name");  
        $stmt->bindParam(':name', $email);
        $stmt->execute();
    
        if($stmt->rowCount() > 0){
          $error1="<div class='text-danger'>Email is taken!</div>";
        }  

        else{


        $role ="student";
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);														
        // $sql = "INSERT INTO user (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
        // VALUES (:username, :email, :userpass, :faculty, :role, :userphone)";
        $sql = "INSERT INTO request (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
        VALUES (:username, :email, :userpass, :faculty, :role, :userphone)";
        $stmt = $conn->prepare($sql);

        //Bind our variables.
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':userpass', $passwordHash);							
        $stmt->bindParam(':faculty', $faculty);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':userphone', $phone);

        //Execute the statement and insert the new account.
        $result = $stmt->execute();

        //If the signup process is successful.
          if($result == 1){	
            $subject = 'Waiting for approval';
            $message = '
            Hello '.$username.',
            
            Your account request has been sent to UOG admin. Please be patient till UOG admin grants you permission to access.
            (This is an automated message, please do not respond to this message.)
            ';
            $mail = new PHPMailer;
            $mail->isSMTP();                                 
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->Port = 587;                                 
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'tls';  								
            $mail->Username = 'segi.aplusenterprise@gmail.com';      // SMTP username
            $mail->Password = 'aplus123';                           // SMTP password
            $mail->setFrom('segi.aplusenterprise@gmail.com', 'GreenwichUniversity');
            $mail->addAddress('khavirna@gmail.com', 'Sample User');     // Add a recipient
            $mail->addAddress($email);               // Name is optional
            $mail->addReplyTo('segi.aplusenterprise@gmail.com', 'Information');
            $mail->isHTML(true);                                 // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            if(!$mail -> send()){
                echo '<script>alert("Email is failed to sent to the user!")</script>';
            }
            else {                
                
         } 



              echo "<script>
              alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.');
              window.location.href='login.php';
              </script>";
          } else {
              
              $invalid_err="<div class='alert alert-danger'> some error occured</div>";
              
          }	
      }
    }
        catch(PDOException $e)
        {
          $e->getMessage();
        }                           
  }     
}
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
<style>

.floating-form {
  width: 320px;
}

.floating-label {
  position: relative;
  margin-bottom: 20px;
}

.floating-input,
.floating-select {
  font-size: 14px;
  padding: 4px 4px;
  display: block;
  width: 100%;
  height: 30px;
  background-color: transparent;
  border: none;
  border-bottom: 1px solid #E6E6E6;
}

.floating-input:focus,
.floating-select:focus {
  outline: none;
  border-bottom: 2px solid #E6E6E6;
}

label {
  color: #999;
  font-size: 14px;
  font-weight: normal;
  position: absolute;
  pointer-events: none;
  left: 5px;
  top: 5px;
  transition: 0.2s ease all;
  -moz-transition: 0.2s ease all;
  -webkit-transition: 0.2s ease all;
}

.floating-input:focus~label,
.floating-input:not(:placeholder-shown)~label {
  top: -18px;
  font-size: 14px;
  color: #5264AE;
}

.floating-select:focus~label,
.floating-select:not([value=""]):valid~label {
  top: -18px;
  font-size: 14px;
  color: #7E74FF;
}


/* active state */

.floating-input:focus~.bar:before,
.floating-input:focus~.bar:after,
.floating-select:focus~.bar:before,
.floating-select:focus~.bar:after {
  width: 50%;
}

*,
*:before,
*:after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.floating-textarea {
  min-height: 30px;
  max-height: 260px;
  overflow: hidden;
  overflow-x: hidden;
}


/* highlighter */

.highlight {
  position: absolute;
  height: 50%;
  width: 100%;
  top: 15%;
  left: 0;
  pointer-events: none;
  opacity: 0.5;
}


/* active state */

.floating-input:focus~.highlight,
.floating-select:focus~.highlight {
  -webkit-animation: inputHighlighter 0.3s ease;
  -moz-animation: inputHighlighter 0.3s ease;
  animation: inputHighlighter 0.3s ease;
}


/* animation */

@-webkit-keyframes inputHighlighter {
  from {
    background: #5264AE;
  }
  to {
    width: 0;
    background: transparent;
  }
}

@-moz-keyframes inputHighlighter {
  from {
    background: #5264AE;
  }
  to {
    width: 0;
    background: transparent;
  }
}

@keyframes inputHighlighter {
  from {
    background: #5264AE;
  }
  to {
    width: 0;
    background: transparent;
  }
}


.login-bg{   
    background-image: url('assets/img/dom-fou-YRMWVcdyhmI-unsplash.jpg');
    background-size: cover;
}
</style>
   
    
</head>

     <title>Sign Up</title>
<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area login-bg">
        <div class="container">
            <div class="login-box ptb--100 ">
            
            <form  action="register.php" name="RegForm" method="post"  onsubmit="return GEEKFORGEEKS()">
                    <div class="login-form-head">
                        <h4>Sign up</h4>
                        <p>Hello there, Sign up and Join with Us</p>
                    </div>
                    <span><?php 	if(isset($invalid_err)){
                    echo $invalid_err;                   
			            	}?>
                     
                     <?php 	if(isset($error1)){
                            echo $error1;                   
			            	        }?></span>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="exampleInputName1">Username</label>
                            <input type="text" id="username" name="username" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                             <!-- Response -->
                             <div id="uname_result"></div>
                            
                        </div>
                       

                        <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="email" name="email">
                            <i class="ti-email"></i>
                            <!-- Response -->                           
                            <div id="email_result"></div>
                        </div>

                        <div class="form-gp">                       
                            <div class="floating-label">
                                <select name="faculty" class="floating-select" onclick="this.setAttribute('value', this.value);" value="">
                                <?php
                                                $que = "SELECT * FROM faculty WHERE FacultyID != '5'";
                                                $result = $conn->prepare($que);                            
                                                $result->execute(); 
                                                $spec = $result->fetchAll();    ?>       
                                                <option value=""></option>   
                                                <?php foreach ($spec as $row): ?>
                                                          <option value="<?php echo htmlentities($row['FacultyID']);?>">
			                                        <?php echo htmlentities($row['FacultyName']);?>
                                                <?php endforeach ?>  
              
                
                                </select>
                            <span class="highlight"></span>
                            <label>Select Faculty</label>
                            <?php 	if(isset($error3)){
                            echo $error3;                   
			            	        }?>
                            </div>   
                          
                        </div>
                        <div class="form-gp">
                            <label for="exampleInput">Contact No</label>
                            <input type="number" id="phone" name="phone" maxlength="11" onKeyDown="limitText(this,11);" onKeyUp="limitText(this,11);"">
                            <i class="ti-mobile"></i>
                            <?php 	if(isset($error2)){
                            echo $error2;                   
			            	        }?>
                        </div>
                                             
                        
                        <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" id="password" name="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="form-gp">
                            <label for="exampleInputPassword2">Confirm Password</label>
                            <input type="password" id="password_repeat"name="password_repeat">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" name ="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                           
                        </div>
                        <div class="form-footer text-center mt-5">
                            <p class="text-muted">Don't have an account? <a href="login.php">Sign in</a></p>
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
    <script> 
            function GEEKFORGEEKS() { 
                var name =  
                    document.forms["RegForm"]["username"]; 
                var email =  
                    document.forms["RegForm"]["email"]; 
                var phone =  
                    document.forms["RegForm"]["phone"]; 
                var faculty =  
                    document.forms["RegForm"]["faculty"]; 
                var password =  
                    document.forms["RegForm"]["password"]; 
                var password_repeat =  
                    document.forms["RegForm"]["password_repeat"];


                   
  
               if (name.value == "") { 
                    window.alert("Please enter your name."); 
                    name.focus(); 
                    return false; 
                } 

              //  else if (!/^[a-zA-Z0-9_-]+$/.test(name)) {                     
              //         window.alert("Invalid characters in username"); 
              //         name.focus();
              //         return false;
              //     }
  
               else if (email.value == "") { 
                    window.alert("Please enter your email."); 
                    email.focus(); 
                    return false; 
                } 

                else if (faculty.selectedIndex < 1) { 
                    alert("Please select your faculty."); 
                    faculty.focus(); 
                    return false; 
                } 
    
                else if (phone.value == "") { 
                    window.alert( 
                      "Please enter your telephone number."); 
                    phone.focus(); 
                    return false; 
                } 
                // else if (!/^[0-9]+$/.test(phone)) {
                //       alert("Invalid characters in phone");
                //       phone.focus();
                //       return false;
                //   }
  
                else if (password.value == "") { 
                    window.alert("Please enter your password"); 
                    password.focus(); 
                    return false; 
                } 
  
                else if (password_repeat.value == "") { 
                    window.alert( 
                      "Please enter confirm password."); 
                      password_repeat.focus(); 
                    return false; 
                }

                else if (password.value !== password_repeat.value)
                      { 
                      alert("Confirm Password should match with the Password"); 
                      return false; 
                      password_repeat.focus(); 
                      } 

                    
               
                return true; 
            } 

            $(document).ready(function () {
              $('#username').on('blur', function () {
                var user_name = $(this).val().trim();
                if (user_name != '') {
                  $.ajax({
                    url: 'fetch.php',
                    type: 'post',
                    data: { user_name: user_name },
                    success: function (response) {
                      $('#uname_result').html(response);
                    }
                  });
                } else {
                  $("#uname_result").html("");
                }
              });
            });


            $(document).ready(function () {
              $('#email').on('blur', function () {
                var email_add = $(this).val().trim();
                if (email_add != '') {
                  $.ajax({
                    url: 'fetch.php',
                    type: 'post',
                    data: { email_add: email_add },
                    success: function (response) {
                      $('#email_result').html(response);
                    }
                  });
                } else {
                  $("#email_result").html("");
                }
              });
            });
            
     function limitText(limitField, limitNum) {
    if (limitField.value.length > limitNum) {
        limitField.value = limitField.value.substring(0, limitNum);
    }
}

$(function() { 
        $("input[name='phone']").on('input', function(e) { 
            $(this).val($(this).val().replace(/[^0-9]/g, '')); 
        }); 
    }); 
        </script> 

</body>

</html>