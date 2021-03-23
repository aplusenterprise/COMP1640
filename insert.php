<?php
include 'config.php';
session_start();

    if($_SESSION['role_level'] != 'student'){
            echo "Unauthorized user. Access denied.";
            die; // stop further execution
    } 

    if(isset($_GET["accept-cookies"])){
        setcookie("accept-cookies", $_SESSION['username'], time()+31556925);
        header("location:student_upload.php");
    }

           
    //Get     
    $fac=$_SESSION['faculty'];
    $d=$_SESSION['username'];
    $user =$_SESSION['userid'];
    
    $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
    $stmt->execute(array($fac));
    $data = $stmt->fetch(PDO::FETCH_OBJ);   
    $facu= $data->FacultyName;

    //error var
    $error_word = "";
    $error_img = "";
    $success_word = "";
    $success_img = "";
    
    if (isset($_POST['submit'])) {  

        error_reporting(0);     

            if(isset($_FILES['images']['name'])):
            define ("MAX_SIZE","2000");
            for($i=0; $i<count($_FILES['images']['name']); $i++)  {
            $size=filesize($_FILES['images']['tmp_name'][$i]);    
            if($size < (MAX_SIZE*1024)):    
            $path = "image/";
            $name = $_FILES['images']['name'][$i];
            $size = $_FILES['images']['size'][$i];
            list($txt, $ext) = explode(".", $name);
            date_default_timezone_set ("Asia/Kuala_Lumpur"); 
            $currentdate=date("d M Y");  
            $file= time().substr(str_replace(" ", "_", $txt), 0);
            $info = pathinfo($file);
            $filename = $file.".".$ext;
                if(move_uploaded_file($_FILES['images']['tmp_name'][$i], $path.$filename)) :
                $fetch=$conn->query("INSERT INTO table_images(images) VALUES('$filename')");
                if($fetch):
                    header('Location:index.php');
                else :
                    $error ='Data not inserting';
                endif;
                else :
                    $error = 'File moving unsuccessful';
                endif;
            else:
                $error = 'You have exceeded the size limit!';
            endif;      
            }
            else:
            $error = 'File not found!';
            endif;          
           
    }

    //Fetch image
    $q="1";
    $que = "SELECT * FROM tbl_images where image_id= '$q'";
    $query = $conn->prepare($que);
    $row = $query->fetch(PDO::FETCH_ASSOC);

            
  ?>