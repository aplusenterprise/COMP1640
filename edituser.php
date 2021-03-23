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
    //Getting the url parameters    
    $query_string = '?'.$_SERVER['QUERY_STRING']; 
    $id=base64_url_decode($_GET['id'])  ; 
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];

    $stmt = "SELECT * FROM user WHERE UserId=:id" ;
    $statement = $conn->prepare($stmt);
    $statement->execute([':id' => $id] );
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $load2= $data->UserName;
    $load3= $data->UserEmail; 
    $load4= $data->UserPhone;
    $load5= $data->FacultyID;  
    $load7= $data->UserRole;       

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($load5));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $load6= $data->FacultyName;
    
    
    if (isset($_POST['update'])) {
      $name=$_POST['username'];
      $email=$_POST['email'];
      $phone=$_POST['phone'];
      $f=$_POST['faculty'];


          
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

            else {
                $query= "SELECT COUNT(StudentSubmissionID) as sum
                FROM studentsubmission
                WHERE UserId=:id ";
                $statement = $conn->prepare($query);
                $statement->execute([':id' => $id] );
                $data = $statement->fetch(PDO::FETCH_OBJ);
                $total= $data->sum;
          
          
                 if ($total >= 1){
                    echo "<script>
                    alert('There is an existing submission under the Faculty. Therefore, not allowed to change the Faculty! ');
                    window.location.href='admin.php';
                    </script>";
                  
                }
                
                else{
          
                  $sql = "UPDATE user SET UserName=:name, UserEmail=:em, UserPhone=:phone , FacultyID =:fid        
                  WHERE UserId=:id"  ;
                  $stmt = $conn->prepare($sql);
                  $stmt->bindParam(":id", $id);
                  $stmt->bindParam(":name", $name);
                  $stmt->bindParam(":em", $email);                   
                  $stmt->bindParam(":phone", $phone);
                  $stmt->bindParam(":fid", $f);                     
                
                      
                  $stmt->execute();
                  header("location:admin.php");
          
          
                }
           

            }
    
           

     
         
      }


      if (isset($_POST['reset'])) {
        $name=$_POST['username'];
        $email=$_POST['email'];
        function random_string($length)
        {
        $string = "";
        $chars = "abcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen($chars);
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, $size - 1)];
        }
        return $string; 
        }

        $random_password = random_string(6);      
        $passwordHash = password_hash($random_password, PASSWORD_DEFAULT);			

        $sql = "UPDATE user SET UserPassword=:pass 
        WHERE UserId=:id"  ;
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":pass", $passwordHash);
             
        $result = $stmt->execute();

        //If the signup process is successful.
          if($result == 1){	
            $subject = 'Password';
            $message = '
            Hello '.$name.',
            
            You are receiving this email because we have reset your password for '.$email.'<br>
            New Password: '.$random_password.'<br>
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
                echo "<script>
                alert('Password has changed successfully. An email is sent to user');
                window.location.href='admin.php';
                </script>";           
                
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
<form  name="EditForm" method="post"  onsubmit="return GEEKFORGEEKS()" action='<?php echo $_SERVER['PHP_SELF'] .$query_string; ?>' enctype='multipart/form-data'>
    
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
                                <h4 class="header-title">Edit User </h4>  
                                <span><?php 	if(isset($invalid_err)){
                                    echo $invalid_err;                   
                                            }?>
                                    
                                    </span>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Username</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $load2 ?>"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Email</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" id="email"  name="email" value="<?php echo $load3 ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Contact No</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo "0$load4"; ?> " maxlength="11" onKeyDown="limitText(this,11);" onKeyUp="limitText(this,11);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Faculty</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                                       
                                        <select name="faculty" class="form-control" id="faculty"  >
                                            <?php
                                               $que = "SELECT * FROM faculty WHERE FacultyID != '5'";
                                               $result = $conn->prepare($que);                            
                                               $result->execute(); 
                                               $spec = $result->fetchAll();    ?>       
                                               <option value=""></option>   
                                               <?php foreach ($spec as $row): ?>
                                                <option value="<?php echo $row['FacultyID']; ?>"<?php if($load5==$row['FacultyID']) echo 'selected="selected"'; ?>><?php echo $row['FacultyName']; ?></option>                                                   
                                               <?php endforeach ?> 
                                    </select>
                                    </div>
                                </div>

                               

                                <div class="form-group">                                
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="update" class="btn btn-success btn-md mb-3">Update</button>
                                        <button type="submit" name="reset" class="btn btn-primary btn-md mb-3"  onclick="return confirm('Do you really want to reset password')">Reset Password</button>
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

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script> 
            function GEEKFORGEEKS() { 
                var name =  
                    document.forms["EditForm"]["username"]; 
                var email =  
                    document.forms["EditForm"]["email"]; 
                var phone =  
                    document.forms["EditForm"]["phone"]; 
                var faculty =  
                    document.forms["EditForm"]["faculty"]; 
              
               if (name.value == "") { 
                    window.alert("Please enter your name."); 
                    name.focus(); 
                    return false; 
                } 
  
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
             
               
                return true; 
            } 

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
