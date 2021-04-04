<?php
include 'config.php';
include 'include/function.php';
require "phpmailer/PHPMailerAutoload.php";
session_start();


    if($_SESSION['role_level'] != 'student'){
        echo "Unauthorized user. Access denied.";      
        header("location:login.php");
    } 

    //Getting the url parameters    
    $query_string = '?'.$_SERVER['QUERY_STRING']; 
    //Getting the id value  
    //$submissionid=$_GET['id'];
    $submissionid=base64_decode($_GET['id']);
    //Getting Session Data     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    $email = $_SESSION['useremail'];
    
    //Getting the faculty Name
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
   
    if (isset($_POST['submitpdf'])) { 
        
        // Validate if files exist
        if (!empty(array_filter($_FILES['upload']['name']))) {
            
            $uploadsDir = "image/";
            $allowedFileType = array('jpg','png','jpeg');

            //Loop through each file 
            for($i=0; $i<count($_FILES['upload']['name']); $i++) {
                $fileName        = $_FILES['upload']['name'][$i];                
                $file_size = $_FILES['upload']['size'][$i];
                $targetFilePath  = $uploadsDir . $fileName;
                $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $ext1 = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);                 
                $filename = "Img_" . rand(10000,99999) . "." . $ext1; 
                $newFilePath = "image/" . $filename;
                //save the url and the file 
                $filePath = "image/" .$_FILES['upload']['name'][$i];      
                //Get the temp file path 
                $tmpFilePath = $_FILES['upload']['tmp_name'][$i];  
                
                //Make sure we have a filepath 
                if(in_array($fileType, $allowedFileType)){
                    if($file_size > 10485760 ){
                        $response= array(
                            "status" => "alert-danger",
                            "message" => "Image Size Should Be less Than 10MB."
                        );}

                    
                    else 
                    {
                        if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                            $files[] = $filename;                 
                        }
                        else{
                            $response = array(
                                "status" => "alert-danger",
                                "message" => "File coud not be uploaded."
                            );
                        }
                        
                    }
                
                } 
                else {
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Only .jpg, .jpeg and .png file formats allowed."
                    );
                }
             
            }
        } 
        else {
            // Error
            $response = array(
                "status" => "alert-danger",
                "message" => "Please select an image to upload."
            );
        
        }

  
      if (!empty(array_filter($_FILES['insert']['name']))) {   
        $uploadsDir = "document/";
        $allowedFileType = array('doc','docx');
      
        for($i=0; $i<count($_FILES['insert']['name']); $i++) { 
        $ext1 = pathinfo($_FILES['insert']['name'][$i], PATHINFO_EXTENSION);
        $fileName        = $_FILES['insert']['name'][$i];
        $tempLocation    = $_FILES['insert']['tmp_name'][$i];
        $targetFilePath  = $uploadsDir . $fileName;
        $fileType        = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); 
        $file_size = $_FILES['insert']['size'][$i];
        
       // $info = pathinfo($_FILES['insert']['name'][$i]);
        //$ext1 = $info['extension'];
        $newname2 = "Doc_" . rand(10000,99999) . "." . $ext1; 
        $newFilePath2 = "document/" . $newname2;
        //Get the temp file path 
        $tmpFilePath = $_FILES['insert']['tmp_name'][$i];  
        

              //Make sure we have a filepath 
              if(in_array($fileType, $allowedFileType)){

                if( $file_size > 10485760 ){
                    $response2 = array(
                        "status2" => "alert-danger",
                        "message2" => "Document Size Should Be less Than 10MB."
                    );}

                
                else 
                {
                    if(move_uploaded_file($tmpFilePath, $newFilePath2)) {
                        $doc[] = $newname2;                  
                    } 
                    else{
                        $response2 = array(
                            "status2" => "alert-danger",
                            "message2" => "File coud not be uploaded."
                        );
                    }
                   
                }
            
            } 
            else {
                $response2 = array(
                    "status2" => "alert-danger",
                    "message2" => "Only .doc and .docx file formats allowed."
                );
            }
         
        }
    } 
    else {
        // Error
        $response2 = array(
            "status2" => "alert-danger",
            "message2" => "Please select an document to upload."
        );
    
    }

    if(empty($_POST['txtTitle']) || empty($_POST['txtDesc']) || empty($doc) || empty($files)){
        $msg="<div class='alert alert-danger'>Please fill up empty field correctly</div>"; 
       }
       
       else{
           
       
       $completeFileName = implode(',',$files); 
       $completeFileName2 = implode(',',$doc);  
       //getting coordinator email
       $cooremail = getcoordinatordetails($fac,$conn);
       $articlename=$_POST['txtTitle'];  
       $articledesc=$_POST['txtDesc'];    
       $que = "INSERT INTO studentsubmission (StudentSubmissionName,StudentSubmissionDescription,Image_url,Document_url,UserId,SubmissionID) VALUES('$articlename','$articledesc' ,'$completeFileName','$completeFileName2','$user','$submissionid')";
       
       if($conn->query($que)){
       $date = date('Y-m-d', strtotime(date("Y-m-d"). ' + 14 days'));
       $subject = 'New Submission in The UOG Management System.';
       $message = '
       Hello.
       There is a new submission on the UOG Portal.
       Submission is from the: '.$email.'
       Please log on and review it at your earliest convenient. Comment function will be available for 14 days till '.$date.'
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
       $mail->addAddress($cooremail);               // Name is optional
       $mail->addReplyTo('segi.aplusenterprise@gmail.com', 'Information');
       $mail->isHTML(true);                                 // Set email format to HTML
       $mail->Subject = $subject;
       $mail->Body    = $message;

       if(!$mail -> send()){
           echo '<script>alert("Email is failed to sent to the coordinator!")</script>';
       }
       else {                
           header('Location:student_upload.php');         
       }

    }}

               
    }
 
  
               
  ?>
  
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.form.js"></script>
    <script type="text/javascript" src="scripts/upload_image.js"></script>
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
<form method='post' action="<?php echo $_SERVER['PHP_SELF'] .$query_string; ?>" enctype='multipart/form-data'>
    
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
       <?php  include 'header-std.php' ?>
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
                    
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.html">Home</a></li>
                                <li><span><?php echo $facu; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">                                
                            <a class="dropdown-item" href="profile.php">Change Password</a>
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- page title area end -->
            <div class="main-content-inner">
                <!-- button srea start -->
              <div class="row">
                   <div class="col-lg-12 mt-5">
                   
                    <span><?php 	if(isset($msg)){
                        echo $msg;                   
                    }?>
                    <?php if(!empty($response)) { ?>
                                       <!-- Error message -->
                                        <div class="alert alert-danger <?php echo $response["status"]; ?>
                                            ">
                                            <?php echo $response["message"]; ?>
                                        </div>
                                        <?php }?>

                                        <?php if(!empty($response2)) { ?>
                                       <!-- Error message -->
                                        <div class="alert alert-danger <?php echo $response2["status2"]; ?>
                                            ">
                                            <?php echo $response2["message2"]; ?>
                                        </div>
                                        <?php }?>
                                        <!-- End error message --></span>
                         <div class="card">
                            <div class="card-body">                                   
                                   <div class="card-header">
                                   <h4 class="header-title text-dark">Upload Article</h4>
                                   <p class="text-muted mb-3">Please fill in all the required fields and adhere to rules and regulations when submiting articles.</p>
                                   </div>
                             <!-- <div class="single-table">   <div class="alert <?php //echo $response["status"]; ?>"> -->

          
              
                             <br><br>  
                            <!-- Upload   -->
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Title</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="text" class="form-control" name="txtTitle">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <textarea class="form-control" aria-label="With textarea" name="txtDesc" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"></textarea>
                                    <!-- <input type="text" class="form-control" name="txtDesc"> -->
                                </div>
                            </div>
                               <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold" for="table_name">Image <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="test" name="upload[]"  multiple="multiple" accept="image/*" >
                                         <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                         <pre id="filelist" style="display:none;"></pre>
                                    </div>
                                    <!-- <div id="text"></div>
                                    <script type="text/javascript">
                                    $('#test').bind('change', function() {
                                        var files = this.files;
                                        var i = 0;
                                        for(; i < files.length; i++) {
                                        var filename = files[i].name + "<br />";
                                        $("#text").append(filename);
                                        }
                                    });
                                    </script> -->
                                    <span>
                                        <strong>Note:</strong>
                                        Only .png, .jpeg, .jpg formats allowed to a max size of 10 MB.                                       
                                    </span>
                                    
                                    <span>
                                    <?php 	
                                    if(isset($msg2)){
                                        echo $msg2;                   
                                    }?>
                </span>
                                    </div>
                                </div> 

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold" for="table_name">Document <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="insert[]"  multiple="multiple"  accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    <pre id="filelist1" style="display:none;"></pre>
                                    </div>
                                    
                                    <!-- <div id="text2"></div>
                                    <script type="text/javascript">
                                    $('#inputGroupFile01').bind('change', function() {
                                        var files = this.files;
                                        var i = 0;
                                        for(; i < files.length; i++) {
                                        var filename = files[i].name + "<br />";
                                        $("#text2").append(filename);
                                        }
                                    });
                                    </script> -->
                                   
                                    <span>

                                        <strong>Note:</strong>
                                        Only .doc and .docx formats allowed to a max size of 10 MB. 
                                        
                                    </span>
                                    <?php 	
                                    if(isset($msg1)){
                                        echo $msg1;                   
                                    }?>
                                    </div>
                                  </div> 
                                  <div class="form-group">
                                        <div class="control-label col-md-3 col-sm-3 col-xs-12">
                                                
                                                <input type="checkbox"  id="exampleCheck1" required name="terms" >
                                                <small class="text-muted">I accept the <a href="#" data-toggle="modal" data-target="#exampleModalCenter">terms and condition.</a></small>
                                               
                                    </div>
                                   <br>
                                   <br>
                                       <div class="form-group">                                          
                                           <button type="submit" name="submitpdf" class="btn btn-success btn-md mb-3">Submit </button>                                         
                                       </div>
                                       <h2><?php //echo @$error ?></h2> 
                           
                            </div>
                               </div>
                        </div>
                       

                        </form>
 <!-- Vertically centered modal start -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Terms And Conditions</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>These terms and conditions apply to undergraduate and postgraduate study 
                                                at the University of Greenwich.</p>
                                                <br>
                                                <p>You should ensure that all of the information you provide to the University in respect of you application is true and accurate.
                                                The Institution may amend or withdraw your Offer of a place or terminate your registration and the Contract if it determines that you have made any fraudulent, false or misleading application or statement to the Institution, or if you have failed to disclose relevant information to the Institution or have produced falsified documents, whether in the process of your application or whilst on your programme.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
 <!-- Vertically centered modal end -->

                    </div>
                </div>
                <!-- button srea end -->
            </div>
        </div>
        <!-- main content area end -->     
    </div>
    <!-- page container area end -->   
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
       $('#test').on( 'change', function() {
       
        myfile= $( this ).val();
        if ($("#test")[0].files.length < 4) {
        
        } else{  
            alert('Only 3 file allowed to upload!');    
            this.value = "";
            
        }
        });

        $('#inputGroupFile01').on( 'change', function() {
       
       myfile= $( this ).val();
       if ($("#inputGroupFile01")[0].files.length < 4) {
       
       } else{  
           alert('Only 3 file allowed to upload!');    
           this.value = "";
           
       }
       });
    </script>

    <script>
        document.getElementById('test').addEventListener('change', function(e) {
        var list = document.getElementById('filelist');
        list.innerHTML = '';
        for (var i = 0; i < this.files.length; i++) {
            list.innerHTML += (i + 1) + '. ' + this.files[i].name + '\n';
        }
        if (list.innerHTML == '') list.style.display = 'none';
        else list.style.display = 'block';
        });

        document.getElementById('inputGroupFile01').addEventListener('change', function(e) {
        var list = document.getElementById('filelist1');
        list.innerHTML = '';
        for (var i = 0; i < this.files.length; i++) {
            list.innerHTML += (i + 1) + '. ' + this.files[i].name + '\n';
        }
        if (list.innerHTML == '') list.style.display = 'none';
        else list.style.display = 'block';
        });
        
    </script>


        



   
</body>

</html>
