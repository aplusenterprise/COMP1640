<?php
session_start();
include_once 'config.php';

if(!empty($_POST["txtspecid"])) {
  
    $que = "SELECT *  FROM submmission where FacultyId ='".$_POST['txtspecid']."' ";
                              
      $result = $conn->prepare($que);                            
      $result->execute(); 
      $spec = $result->fetchAll();    ?>
    
                                                        
   <option selected="selected">Select Doctor </option>             
  <?php foreach ($spec as $row): ?>
    <option value="<?php echo htmlentities($row['SubmissionName']); ?>"><?php echo htmlentities($row['SubmissionName']); ?></option>
     
  <?php endforeach ?>
  
  <?php
    
  }



?>
