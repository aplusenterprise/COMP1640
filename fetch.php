
<?php

//fetch.php

include('config.php');

if(isset($_POST["year"]))
{
    $query = "SELECT * , COUNT(studentsubmission.studentsubmissionID) AS total FROM submission 
    INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
    INNER JOIN faculty ON submission.FacultyID = faculty.FacultyID
    WHERE AcademicYear ='".$_POST["year"]."' GROUP BY submission.FacultyID";



 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'faculty'   => $row["FacultyName"],
   'total'  => $row["total"]
  );
 }
 echo json_encode($output);
}

if(isset($_POST['user_name'])) {
    $user_name = $_POST['user_name'];      
    $stmt = $conn->prepare("SELECT count(*) as UserName FROM user WHERE UserName=:username");
    $stmt->bindValue(':username', $user_name, PDO::PARAM_STR);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();

     
    $stmt2 = $conn->prepare("SELECT count(*) as UserName FROM request WHERE UserName=:username");
    $stmt2->bindValue(':username', $user_name, PDO::PARAM_STR);
    $stmt2->execute(); 
    $count2 = $stmt2->fetchColumn();

    if (!preg_match("/^[a-zA-Z-' ]*$/",$user_name)) {
      echo '<span class="text-danger">Only letters and white space allowed!</span>';
    }
    else{
      if($count > 0){
        echo '<span class="text-danger">Username <b>'.$user_name.'</b> is already taken!</span>';
      } 
      
      else if($count2 > 0){
        echo '<span class="text-danger">Username <b>'.$user_name.'</b> is already taken!</span>';
      }
      else {       
        echo '<span class="text-success">Username <b>'.$user_name.'</b> is available!</span>';
      }

    }

    
  }

  if(isset($_POST['email_add'])) {
    $email = filter_var($_POST['email_add'], FILTER_SANITIZE_EMAIL);
    $email_add = $_POST['email_add'];      
    $stmt = $conn->prepare("SELECT count(*) as UserEmail FROM user WHERE UserEmail=:email");
    $stmt->bindValue(':email', $email_add, PDO::PARAM_STR);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();

    $stmt2 = $conn->prepare("SELECT count(*) as UserEmail FROM request WHERE UserEmail=:email");
    $stmt2->bindValue(':email', $email_add, PDO::PARAM_STR);
    $stmt2->execute(); 
    $count2 = $stmt2->fetchColumn();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo '<span class="text-danger">Invalid email format!</span>';
    }
  else{
    if($count > 0){
      echo '<span class="text-danger">Email <b>'.$email_add.'</b> is already taken!</span>';
    }
    else if($count2 > 0){
      echo '<span class="text-danger">Email <b>'.$email_add.'</b> is already taken!</span>';
    } else {       
      echo '<span class="text-success">Email <b>'.$email_add.'</b> is available!</span>';
    }

  }

   
  }
  
  if(isset($_POST['user_name1'])) {
    $user_name = $_POST['user_name1'];      
    $stmt = $conn->prepare("SELECT count(*) as UserName FROM user WHERE UserName=:username");
    $stmt->bindValue(':username', $user_name, PDO::PARAM_STR);
    $stmt->execute(); 
    $count = $stmt->fetchColumn();

    if($count > 0){
      echo '<span class="text-danger">Username <b>'.$user_name.'</b> is already taken!</span>';
    } else {       
      echo '<span class="text-success">Username <b>'.$user_name.'</b> is available!</span>';
    }
  }

?>