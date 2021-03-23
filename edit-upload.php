<?php
include 'config.php';
include 'include/function.php';
session_start();

    if($_SESSION['role_level'] != 'student'){
        echo "Unauthorized user. Access denied.";      
        header("location:login.php");
    } 
           
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
 

    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =?");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;
    
   //Getting the url parameters    
    $query_string = '?'.$_SERVER['QUERY_STRING']; 
    $id = urlsafe_b64decode($_GET['id']);	 
    $fac=$_SESSION['faculty'];


   if (isset($_POST['submit'])) {
       
       $id = $_POST['id'];
       $name = $_POST['name'];
       $desc = $_POST['desc'];

      

       

       if(empty($_POST['name']) || empty($_POST['desc']) ){
        echo '<script>alert("Fill up empty field")</script>';
       
         }
            
            else  {

                if(isset($_FILES['upload'])) {
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
                        if( $file_size > 102400 ){
                            echo '<script>alert("Image Size Should Be less Than 10MB")</script>';
                             
                           
                         }
     
                        
                             if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                                 $files[] = $filename;   
                                 $completeFileName = implode(',',$files);  
                                 $sql2 = "UPDATE studentsubmission SET Image_url=:image WHERE StudentSubmissionID=:id"  ;  
                                 $stmt = $conn->prepare($sql2);  
                                 $stmt->bindParam(":id", $id);
                                 $stmt->bindParam(":image", $completeFileName);  
                                 $ex= $stmt->execute();
                                 header('Location:student_upload.php'); 
                                    
                                
                                  
                             } 
                           
                       
                    
                    } 
                   
                 
                }
            }

             if(isset($_FILES['insert'])) {
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
         
                        if( $file_size > 102400 ){
                            echo '<script>alert("Image Size Should Be less Than 10MB")</script>';
                         }
                            
         
         
                        if(move_uploaded_file($tmpFilePath, $newFilePath2)) {
                            $doc[] = $newname2;         
                            $completeFileName2 = implode(',',$doc);   
                            $sql2 = "UPDATE studentsubmission SET Document_url=:document WHERE StudentSubmissionID=:id"  ;  
                            $stmt = $conn->prepare($sql2);  
                            $stmt->bindParam(":id", $id);
                            $stmt->bindParam(":document", $completeFileName2); 
                            $ex= $stmt->execute(); 
                            header('Location:student_upload.php'); 
                            
                            
                        } 
                      
                    
                    } 
                 
                 
                }
            }

           
                $sql = "UPDATE studentsubmission SET StudentSubmissionName=:name, StudentSubmissionDescription=:desc       
                WHERE StudentSubmissionID=:id"  ;
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":desc", $desc);          
                $stmt->execute();
                header('Location:student_upload.php');         

           



        }



     
       
 

 
   
      
       
       
  
      
   }
 

       $stmt = "SELECT * FROM studentsubmission WHERE StudentSubmissionID=:id" ;
       $statement = $conn->prepare($stmt);
       $statement->execute([':id' => $id] );
       $data = $statement->fetch(PDO::FETCH_OBJ);
       $load2= $data->StudentSubmissionID;
       $load3= $data->StudentSubmissionName; 
       $load4= $data->StudentSubmissionDescription;
       $load5= $data->Image_url; 
       $load6= $data->Document_url;
       $load7= $data->UserId; 

    
                
  ?>
  
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">      
    
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
   

    <style>
    
        .photo-gallery {
  color:#313437;
  background-color:#fff;
}

.photo-gallery p {
  color:#7d8285;
}

.photo-gallery h2 {
  font-weight:bold;
  margin-bottom:40px;
  padding-top:40px;
  color:inherit;
}

@media (max-width:767px) {
  .photo-gallery h2 {
    margin-bottom:25px;
    padding-top:25px;
    font-size:24px;
  }
}

.photo-gallery .intro {
  font-size:16px;
  max-width:500px;
  margin:0 auto 40px;
}

.photo-gallery .intro p {
  margin-bottom:0;
}

.photo-gallery .photos {
  padding-bottom:20px;
}

.photo-gallery .item {
  padding-bottom:30px;
}
.bg-custom{
    background: -webkit-linear-gradient(left, #8914fe 0%, #8063f5 100%);
    background: linear-gradient(to right, #8914fe 0%, #8063f5 100%);
    
}
    </style>
</head>
<body>
<form method='post' action='<?php echo $_SERVER['PHP_SELF'] .$query_string; ?>' enctype='multipart/form-data'>
    
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
                                <li><span><?php echo "Faculty of $facu"; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="assets/img/author/avatar.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $d; ?><i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">   
                                <a class="dropdown-item" href="#">Change Password</a>                                
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
                                   <h4 class="header-title text-dark">Edit Article </h4>
                                   
                                   </div>
                             <!-- <div class="single-table">   <div class="alert <?php //echo $response["status"]; ?>"> -->
                             <div class="form-group">
                                <label for="id" hidden="true">Submission ID</label>
                                <input type="text" class="form-control" id="id" name="id" value="<?php echo $load2 ?>" readonly="true" hidden="true"/>
                            </div>

                             <br><br>  
                            <!-- Upload   -->
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Title</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="text" class="form-control" name="name" value="<?php echo $load3 ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Description</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                   <textarea class="form-control" aria-label="With textarea" name="desc" style="margin-top: 0px; margin-bottom: 0px; height: 100px;"><?php echo $load4?></textarea>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Image</label>                                 		
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <span><p><small><strong><?php echo "Uploaded file: $load5 "?></strong></small></p></span>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="test" name="upload[]" onchange="return fileValidation()" onclick="FileDetails()" multiple="multiple"  accept="image/*" >
                                    <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>                                    
                                    </div>
                                    <pre id="filelist" style="display:none;"></pre>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label for="input" class="control-label col-md-3 col-sm-3 col-xs-12 font-weight-bold">Document</label>
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <span><p><small><strong><?php echo "Uploaded file: $load6 "?></strong></small></p></span>
                                <div class="custom-file">                
                                    <input type="file"  class="custom-file-input" id="inputGroupFile02" name="insert[]"  multiple="multiple"  accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                        <label class="custom-file-label" for="inputGroupFile02">Choose Document</label>
                                     
                                    </div>
                                    <pre id="filelist1" style="display:none;"></pre>
                                </div>
                            </div>
                             
                         
                            <div class="form-group">                                          
                             <?php  disableEditbtn($load2,$fac,$conn) ?>                                        
                            </div>
                                        
                           
                            </div>
                               </div>
                        </div>
                 
                           
                            </div>
                               </div>
                        </div>
                    </div>
                </div>
                         
                </div>
                <!-- button srea end -->
            </div>
        </div>
        <!-- main content area end -->
     </form>
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

    // var uploadField = document.getElementById("test");

    // uploadField.onchange = function() {
    //     if(this.files[0].size > 10485760){
    //     alert("File is too big!");
    //     this.value = "";
    //     };
    // };
    var uploadField = document.getElementById("test");    
    uploadField.onchange = function() {
        var files = $('#test')[0].files;
        for(var i = 0; i<files.length; i++){
        //console.log(files[i].name+'----'+files[i].size);
        if(this.files[i].size > 10485760){
        alert("File is too big!");
        this.value = "";
        }
        };
    };
        

    
    var uploadField2 = document.getElementById("inputGroupFile02");
    uploadField2.onchange = function() {
        var files = $('#inputGroupFile02')[0].files;
        for(var i = 0; i<files.length; i++){
        //console.log(files[i].name+'----'+files[i].size);
        if(this.files[i].size > 10485760){
        alert("File is too big!");
        this.value = "";
        }
        };

        // if(this.files[0].size > 10485760){
        // alert("File is too big!");
        // this.value = "";
        // };
    };

    //  $(document).ready(function(){
    //     $('#test').change(function(){
    //             var fp = $("#test");
    //             var lg = fp[0].files.length; // get length
    //             var items = fp[0].files;
    //             var fileSize = 0;
           
    //         if (lg > 0) {
    //            for (var i = 0; i < lg; i++) {
    //                fileSize = fileSize+items[i].size; // get file size
                   
    //             }
    //             //10485760bytes = 10MB
    //             if(fileSize > 10485760) {
    //                  alert('File size must not be more than 10 MB');
    //                  $('#test').val('');
    //             }
    //         }
    //      });
    //  });
    
    $('#inputGroupFile02').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="docx" || ext=="doc"){
        //    alert(ext);
    } else{  
        alert('Only doc. and docx file allowed!');    
        this.value = "";
    }
    });

    $('#test').on( 'change', function() {
    myfile= $( this ).val();
    var ext = myfile.split('.').pop();
    if(ext=="jpg" || ext=="png" || ext=="jpeg"){
        //    alert(ext);
    } else{  
        alert('Only .jpg, .jpeg and .png file allowed!');    
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

        document.getElementById('inputGroupFile02').addEventListener('change', function(e) {
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
