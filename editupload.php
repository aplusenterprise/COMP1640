<?php
 include 'config.php';
 include 'include/function.php';
 session_start();

 if($_SESSION['role_level'] != 'student'){
    echo "Unauthorized user. Access denied.";      
    header("location:login.php");

    //Getting the url parameters    
    $query_string = '?'.$_SERVER['QUERY_STRING']; 
} 
    $id=urlsafe_b64decode($_GET['id']);
    //  $id = $_GET['id'];	 
     $fac=$_SESSION['faculty'];

    if (isset($_POST['submit'])) {
        
        $id = $_POST['id'];
    	$name = $_POST['name'];
        $desc = $_POST['desc'];

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
                    if( $file_size > 102400 ){
                        $response= array(
                            "status" => "alert-danger",
                            "message" => "Image Size Should Be less Than 10MB."
                        );}

                    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $files[] = $filename;   
                            $completeFileName = implode(',',$files);  
                            $sql2 = "UPDATE studentsubmission SET Image_url=:image WHERE StudentSubmissionID=:id"  ;  
                            $stmt = $conn->prepare($sql2);  
                            $stmt->bindParam(":id", $id);
                            $stmt->bindParam(":image", $completeFileName);  
                            $stmt->execute();                         
                    } 
                    else 
                    {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
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
                    $response2 = array(
                      "status2" => "alert-danger",
                         "message2" => "Document Size Should Be less Than 10MB."
                    );}
                    //header("Location: student_upload.php");}


                if(move_uploaded_file($tmpFilePath, $newFilePath2)) {
                    $doc[] = $newname2;         
                    $completeFileName2 = implode(',',$doc);   
                    $sql2 = "UPDATE studentsubmission SET Document_url=:document WHERE StudentSubmissionID=:id"  ;  
                    $stmt = $conn->prepare($sql2);  
                    $stmt->bindParam(":id", $id);
                    $stmt->bindParam(":document", $completeFileName2);  
                    $stmt->execute(); 
                } 
                else 
                {
                    $response2 = array(
                        "status2" => "alert-danger",
                        "message2" => "File coud not be uploaded."
                    );
                   
                }
            
            } 
            else {
                $response2 = array(
                    "status2" => "alert-danger",
                    "message2" => "Only .doc and .docx file formats allowed."
                );
                
            }
         
        }
    
        if(empty($response) || empty($response2)  ){
            $msg="<div class='alert alert-danger'>Please fill up empty field correctly</div>"; 
           }
       else{    
        $sql = "UPDATE studentsubmission SET StudentSubmissionName=:name, StudentSubmissionDescription=:desc       
         WHERE StudentSubmissionID=:id ";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(":id", $id);
          $stmt->bindParam(":name", $name);
          $stmt->bindParam(":desc", $desc);          
		 $stmt->execute();
    	 header("location:student_upload.php");
    }}


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
<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

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
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] .$query_string; ?>"  enctype="multipart/form-data">
<div class="modal-header">
        <h5 class="modal-title">Edit Submission</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <span>
        
        <?php 	if(isset($msg)){
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
      </div>
	<div class="modal-body">
		<div class="form-group">
			<label for="id" hidden="true">Submission ID</label>
			<input type="text" class="form-control" id="id" name="id" value="<?php echo $load2 ?>" readonly="true" hidden="true"/>


		</div>
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php echo $load3 ?>" />
		</div>
        <div class="form-group">
			<label for="desc">Description</label>
			<input type="text" class="form-control" id="desc" name="desc" value="<?php echo $load4 ?>" />
		</div>
		<div class="form-group">
            <label for="image">Image</label>
            <p><small><strong><?php echo "Uploaded file: $load5 "?></strong></small></p>		
          
			<div class="custom-file">

                <input type="file" class="custom-file-input" id="test" name="upload[]"  multiple="multiple" accept="image/*" >
                <label class="custom-file-label" for="inputGroupFile01">Choose Image</label>
            </div>
		</div>
        
        <div class="form-group">
            <label for="doc">Document</label>
            <p><small><strong><?php echo "Uploaded file: $load6 "?></strong></small></p>	
            	
             <div class="custom-file">                
            <input type="file" class="custom-file-input" id="inputGroupFile02" name="insert[]"  multiple="multiple"  accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                <label class="custom-file-label" for="inputGroupFile01">Choose Document</label>
            </div>
		</div>
        
    
	</div>
	
          <?php  
          
            
                disableEditbtn($load2,$fac,$conn) ?>                                            
                                       
			<!-- <input type="submit" class="btn btn-primary" name="submit" value="Update" /> -->
            <!-- &nbsp;
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
		</div>
	</form>
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
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