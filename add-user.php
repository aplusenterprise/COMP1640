<?php
include 'config.php';
include 'include/function.php';
require "phpmailer/PHPMailerAutoload.php";

session_start();
 if($_SESSION['role_level'] != 'admin')
 {
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");
 } 

    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];

     
    if (isset($_POST['add'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $faculty = $_POST['faculty'];
        $role = $_POST['role'];
        $password = $_POST['password'];
        $emailadd = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


         if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
            $invalid_err="<div class='text-danger'>Only letters and white space allowed for Username!</div>";   
           
          }
          
          else if (!filter_var($emailadd, FILTER_VALIDATE_EMAIL)) {
            $invalid_err="<div class='text-danger'>Invalid email format!</div>"; 
            
          }

         else if (!preg_match('/(0[0-9]{9})/', $phone)){
            $invalid_err="<div class='text-danger'>Invalid phone format!</div>";
          }
        //   else if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
        //     $invalid_err="<div class='text-danger'>Invalid phone format!</div>";   
            
        //   }

          else{
            $stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE UserName = :name OR UserEmail = :email");
            $stmt->execute(array(':name'  => $username,':email' => $email));
            $count = $stmt->fetchColumn();
            
            if ($count > 0) {
                $invalid_err="<div class='text-danger'>Email or Username is taken!</div>";                
            } 	
            
           else{
               
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);														
            // $sql = "INSERT INTO user (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
            // VALUES (:username, :email, :userpass, :faculty, :role, :userphone)";
            $sql = "INSERT INTO user (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
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
            $subject = 'An account is created by UOG Admin';
            $message = '
            Hello '.$username.', An account has been created for you.
            <br>
            Account details:
            <br>Login info: '.$email.'<br>
            Password: '.$password.'<br>
            Role: '.$role.'<br>
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
            $mail->addAddress($email);               // Name is optional
            $mail->addReplyTo('segi.aplusenterprise@gmail.com', 'Information');
            $mail->isHTML(true);                                 // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
        
            if(!$mail -> send()){
                echo '<script>alert("Email is failed to sent to the user!")</script>';
            }
            else {                
                    
              echo "<script>
              alert('Account is created.');
              window.location.href='admin.php';
              </script>";}
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
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/img/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amcharts css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    
</head>

<body> 
<form method='post' action='add-user.php' enctype='multipart/form-data' name="AddForm"  onsubmit="return UserValidation()">
    
    <!-- preloader area start -->
    
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'sidebar.php' ?>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        
                    </div>
                    <!-- profile info & task notification -->
                
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard </h4>
                            <ul class="breadcrumbs pull-left">
                              
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d;?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- button srea start -->            
                <div class="row justify-content-md-center">
                    <div class="col">
                        <div class="card">                        
                            <div class="card-body">                        
                                <h4 class="header-title">Add User </h4>  
                                <span><?php 	if(isset($invalid_err)){
                                    echo $invalid_err;                   
                                            }?>
                                    
                                    </span>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Username</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" name="username" id="username" > 
                                        <div id="uname_result"></div>
                                    </div>
                                                 <!-- Response -->
                            
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Email</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" name="email" id="email">
                                                 <!-- Response -->                           
                                                 <div id="email_result"></div>
                                    </div>
                           
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Contact No</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="number" class="form-control" name="phone" id="phone" maxlength="11"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Faculty</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                       
                                    <select name="faculty" class="form-control">
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
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Role</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                       
                                    <select name="role" id="role" class="form-control">
                                <?php
                                                $que = "SELECT * FROM user WHERE UserRole != 'admin'  GROUP BY UserRole";
                                                $result = $conn->prepare($que);                            
                                                $result->execute(); 
                                                $spec = $result->fetchAll();    ?>       
                                                <option value=""></option>   
                                                <?php foreach ($spec as $row): ?>
                                                          <option value="<?php echo htmlentities($row['UserRole']);?>">
			                                        <?php echo htmlentities($row['UserRole']);?>
                                                <?php endforeach ?>  
              
                
                                </select>
                                    </div>
                                </div>

                              
                                <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">  
                                <input type="password" class="form-control" name="password" id="password">
                                </div>
                        </div>

                                <div class="form-group">                                
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="add" class="btn btn-success btn-md mb-3">Add</button>
                                    </div>
                                    
                                </div>
                            </div> 
                                    
                        </div>
                    </div>
                </div>
              <!-- button srea end -->  
                 
             
        </div>
        <!-- main content area end -->
        </div>
     </form>
    </div>
    <!-- page container area end -->
    <script src="main.js"></script>
    <!-- offset area end -->
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
function UserValidation() { 
                var name =  
                    document.forms["AddForm"]["username"]; 
                var email =  
                    document.forms["AddForm"]["email"]; 
                var phone =  
                    document.forms["AddForm"]["phone"]; 
                var faculty =  
                    document.forms["AddForm"]["faculty"]; 
                var role =  
                    document.forms["AddForm"]["role"]; 
                var password =  
                    document.forms["AddForm"]["password"]; 
                
                if (name.value == "") { 
                    window.alert("Please enter username."); 
                    name.focus(); 
                    return false; 
                } 
  
               else if (email.value == "") { 
                    window.alert("Please enter email."); 
                    email.focus(); 
                    return false; 
                } 

                else if (phone.value == "") { 
                    window.alert( 
                      "Please enter telephone number."); 
                    phone.focus(); 
                    return false; 
                } 
                else if (/^[0-9]+$/.test(phone)) {
                       alert("Invalid characters in phone");
                       phone.focus();
                      return false;
                  }

                else if (faculty.selectedIndex < 1) { 
                    alert("Please select your faculty."); 
                    faculty.focus(); 
                    return false; 
                } 

                else if (role.selectedIndex < 1) { 
                    alert("Please select role."); 
                    role.focus(); 
                    return false; 
                } 
              
              

                 
  
                else if (password.value == "") { 
                    window.alert("Please enter password"); 
                    password.focus(); 
                    return false; 
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
            
            

        </script> 

  
</body>

</html>
