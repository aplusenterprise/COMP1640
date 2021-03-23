<?php
include 'config.php';
require "phpmailer/PHPMailerAutoload.php";
include 'include/function.php';
session_start();

// sql to delete a record
if (isset($_GET['type'])) {
    $id=urlsafe_b64decode($_GET['id']);
    $type = $_GET['type'];
   //$id = $_GET['id'];
    
    if ($type == "closure"){
        delUser($id, $conn);
    }
    if ($type == "request"){
        delRequest($id, $conn);
    }
    if ($type == "accept"){
        accRequest($id, $conn);
    }
    if ($type == "faculty"){
        delFalc($id, $conn);
    }
    if ($type == "year"){
        $faculty = $_GET['faculty'];
        $year = $_GET['year'];
        checkYear($faculty,$year, $conn);
    }
    
}



function delRequest($id, $conn){

    $stmt = "SELECT * FROM request WHERE RequestID=:id" ;
    $statement = $conn->prepare($stmt);
    $statement->execute([':id' => $id] );
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $load2= $data->UserName;
    $load3= $data->UserEmail; 
    $load4= $data->UserPhone;
    $load5= $data->FacultyID;  
    $load7= $data->UserRole;     
    
    $subject = 'Account Rejected by The UOG Admin.';
    $message = '
    Hello '.$load2.',
    
    Your account '.$load3.', has been rejected. 
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
    $mail->addAddress($load3);               // Name is optional
    $mail->addReplyTo('segi.aplusenterprise@gmail.com', 'Information');
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    if(!$mail -> send()){
        echo '<script>alert("Email is failed to sent to the user!")</script>';
    }
    else {                
        
 }
    $sql = "DELETE FROM request WHERE RequestID=$id";   
    if ($conn->query($sql) === TRUE) {
       
        echo "<script>
            alert('Reject Successfully');
            window.location.href='userlist.php';
            </script>";
      
      
    } else {
       
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function delUser($id, $conn){
    $query= "SELECT COUNT(StudentSubmissionID) as sum
    FROM studentsubmission
    WHERE SubmissionID=:id ";
   $statement = $conn->prepare($query);
    $statement->execute([':id' => $id] );
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $total= $data->sum;
    if ($total >= 1){
        echo "<script>
        alert('There is existing student contribution under the submission.Therefore, not allwowed to delete!');
        window.location.href='closure-date.php';
        </script>";
      
    }
    else{
        
        $sql = "DELETE FROM submission WHERE SubmissionID=$id";   
        $statement = $conn->prepare($sql);
        $ex= $statement->execute();
         if ($ex == 1) {
        
            echo "<script>
            alert('Delected Successfully');
            window.location.href='closure-date.php';
            </script>";
          
        } else {
           
        }
  }
 
  
}

function accRequest($id, $conn){

    $stmt = "SELECT * FROM request WHERE RequestID=:id" ;
        
        $statement = $conn->prepare($stmt);
        $statement->execute([':id' => $id] );
        $data = $statement->fetch(PDO::FETCH_OBJ);
        $load2= $data->UserName;
        $load3= $data->UserEmail; 
        $load4= $data->UserPhone;
        $load5= $data->FacultyID;  
        $load7= $data->UserRole;     
        
    $subject = 'Account Approved by The UOG Admin.';
    $message = '
    Hello '.$load2.',
    
    Your account '.$load3.', has been approved. 
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
    $mail->addAddress($load3);               // Name is optional
    $mail->addReplyTo('segi.aplusenterprise@gmail.com', 'Information');
    $mail->isHTML(true);                                 // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;

    if(!$mail -> send()){
        echo '<script>alert("Email is failed to sent to the user!")</script>';
    }
    else {                
        
 } 
    $query = "SELECT * FROM request WHERE RequestID = '$id'; ";
    $result = $conn->query($query);                                                
    if($result->rowCount() > 0){
        while($row = $result->fetch()){ 

            $username = $row['UserName'];
            $email = $row['UserEmail'];
            $pass = $row['UserPassword'];
            $fid = $row['FacultyID'];
            $role = $row['UserRole'];
            $phone = $row['UserPhone'];            

            $query = "INSERT INTO user (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
            VALUES ( '$username' , '$email', '$pass', '$fid', '$role', '$phone')";
      
        }
        $conn->prepare("DELETE FROM request WHERE RequestID = ?")->execute([$id]);    
        
        if($conn->query($query) === TRUE){
            echo "Account has been accepted.";
        }else{
            echo "Unknown error occured. Please try again.";
        }
    }else{
        echo "Error occured.";
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function delFalc($id, $conn){

    $query= "SELECT COUNT(FacultyID) as sum
    FROM user
    WHERE FacultyID=:id ";

    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id] );
    $data = $statement->fetch(PDO::FETCH_OBJ);
    $total= $data->sum;
    if ($total >= 1){
        echo "<script>
        alert('There are users under the faculty therefore admin are not allowed to delete');
        window.location.href='faculty.php';
        </script>";
      
    }
    else{
        $sql = "DELETE FROM faculty WHERE FacultyID=$id"; 
        $statement = $conn->prepare($sql);
       $ex= $statement->execute();
        if ($ex == 1) {
            //echo "Record deleted successfully";           
            echo "<script>
            alert('Record deleted successfully');
            window.location.href='faculty.php';
            </script>"; 
        
        } else {
        
        }
}
 
   
}
//header('Location: ' . $_SERVER['HTTP_REFERER']);


?>