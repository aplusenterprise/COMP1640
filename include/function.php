<?php
require 'config.php';

//base64_encode -Encodes data  with MIME base64
function base64_url_encode($input)
{
return strtr(base64_encode($input), '+/=', '-_,');
}
//base64_decode -Decodes data encoded with MIME base64.
function base64_url_decode($input)
{
return base64_decode(strtr($input, '-_,', '+/='));
}

function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_',''),$data);
    return $data;
}

function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}



function getrequest( $conn)
{
	$query = "SELECT * FROM request;";
      $result = $conn->query($query);                                                
        if($result->rowCount() > 0){
            while($row = $result->fetch()){ 
                $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
                $stmt->execute(array($row['FacultyID']));
                $data = $stmt->fetch(PDO::FETCH_OBJ);   
                $facu= $data->FacultyName;

                $sql = "INSERT INTO request (UserName, UserEmail, UserPassword, FacultyID, UserRole, UserPhone) 
                VALUES (:username, :email, :userpass, :faculty, :role, :userphone)"; 
                 $rid = $row['RequestID'];  
                 $newrowid=urlsafe_b64encode($row['RequestID']);
                 ?>
                 <tr>
                  <td><?php echo $row['UserName']?></td>  
                  <td><?php echo $row['UserEmail']?></td>  
                  <td><?php echo $facu ?></td>                     
                  <td><a href='delete.php?type=request&id=<?php echo $newrowid ?>' class='btn btn-secondary my-2' > Reject</a></td>  
                  <td><a href='delete.php?type=accept&id=<?php echo $newrowid ?>' class='btn btn-secondary my-2'  onclick="return confirm('Do you really want to Accept the Account')"> Accept</a></td>                                                              
                  </tr><?php                                                          
                                                                       
            }                                              
                                                        
        } 
        		
}

function getstudents($userrole, $conn)
{
    
	$query = "SELECT * FROM user WHERE UserRole='$userrole';";
      $result = $conn->query($query);                                                
        if($result->rowCount() > 0){
            while($row = $result->fetch()){ 
                $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
                $stmt->execute(array($row['FacultyID']));
                $data = $stmt->fetch(PDO::FETCH_OBJ);   
                $facu= $data->FacultyName;
                //$newrowid=base64_url_encode($row['UserId'])  ;                 
                $newrowid=urlsafe_b64encode($row['UserId']);
               
 

                 ?>
                 <tr>
                 <td><?php echo $row['UserId']?></td>  
                  <td><?php echo $row['UserName']?></td>  
                  <td><?php echo $row['UserEmail']?></td>  
                  <td><?php echo $facu ?></td> 
                  <td><a href='edituser.php?id=<?php echo $newrowid ?>' class='btn btn-secondary ' 
                  onclick="return confirm('Do you really want to Edit the Account')"> Edit</a></td>  
                
                  </tr><?php                                                          
                                                                       
            }                                              
                                                        
        } 
        		
}

function geteveryuser($userrole, $conn)
{
    
	$query = "SELECT * FROM user WHERE UserRole='$userrole';";
      $result = $conn->query($query);                                                
        if($result->rowCount() > 0){
            while($row = $result->fetch()){               
                        
                     
                $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
                $stmt->execute(array($row['FacultyID']));
                $data = $stmt->fetch(PDO::FETCH_OBJ);   
                $facu= $data->FacultyName;
                
               
 
                                                          
                                                                       
            }                                              
                                                        
        } 
        		
}

function getsubmission($f, $conn)
{
	$query = "SELECT * FROM studentsubmission 
    INNER JOIN submission ON studentsubmission.SubmissionID = submission.SubmissionID 
    INNER JOIN user ON studentsubmission.UserId = user.UserId 
    WHERE submission.FacultyID = $f AND studentsubmission.StudentSubmissionStatus = 0 AND submission.AcademicYear= YEAR(CURDATE()) 
    ORDER BY StudentSubmission.StudentSubmissionTime ASC;
     ";
      $result = $conn->query($query);
                                                
        if($result->rowCount() > 0){
            while($row = $result->fetch()){  
                   
              $rowid = $row['StudentSubmissionID'];  
              $newrowid=base64_url_encode($rowid)  ;           
              $row['Document_url'] = trim($row['Document_url'],'\,');
              $temp = explode(',',$row['Document_url'] );                                                       
              $s = array_filter($temp); 
              $ds = trim($row['Document_url'],'\,');
              $img = explode(" , ", $ds);
              //print_r($ds);
              foreach($img as $keys) {    
                $kik= '"'.$keys.'"<br/>';    
               

            }
                 
                foreach($s as $key => $ews)
                  : 
                  $j[]=  $ews;
                  $link="<a href='document/$ews'>$ews </a>";                                                            
                  endforeach;
                 
                    echo "<tr>";
                        echo "<td>".$row['UserEmail']."</td>";   
                        echo "<td>".$row['StudentSubmissionName']."</td> "; 
                        // echo "<td><a href='document/".$kik."'>".$kik." </a></td>";  
                        // echo "<td>".$row['Image_url']."</td>";                          
                        echo "<td>".$row['StudentSubmissionTime']."</td>";  
                        echo "<td><a href='comment.php?id=".$newrowid." ' class='btn btn-s btn-dark'>View to Comment</a></td>";  
                        echo "<td> <button class='btn btn-s btn-primary mb-3 publishBtn'  value=" . $rowid . ">Publish</button></td>";
                                                                                                         
        
                    echo "</tr>";                                                              
                 }                                              
                                                        
                } else {
                    echo "No results";
                }

             
			
		
}
function getpublish($f, $conn)
{
	$query = "SELECT * FROM studentsubmission 
    INNER JOIN submission ON studentsubmission.SubmissionID = submission.SubmissionID 
    INNER JOIN user ON studentsubmission.UserId = user.UserId 
    WHERE submission.FacultyID = $f AND studentsubmission.StudentSubmissionStatus = 1 AND submission.AcademicYear= YEAR(CURDATE()) 
    ORDER BY StudentSubmission.StudentSubmissionTime ASC;
     ";
      $result = $conn->query($query);                                                
        if($result->rowCount() > 0){
            while($row = $result->fetch()){                                                        
                   
                $rowid = $row['StudentSubmissionID'];               
                $row['Document_url'] = trim($row['Document_url'],'\,');
                $temp = explode(',',$row['Document_url'] );                                                       
                $s = array_filter($temp);              
                $newrowid=base64_url_encode($rowid)  ;                            
                    foreach($s as $key => $ews)
                    :   
                    $link="<a href='document/$ews'>  $ews </a>";                                                            
                    endforeach;
                   
                            echo "<tr>";
                            echo "<td>".$row['UserEmail']."</td>";    
                            echo "<td>".$row['StudentSubmissionName']."</td> ";                         
                            echo "<td>".$row['StudentSubmissionTime']."</td>";  
                            echo "<td><a href='comment.php?id=".$newrowid." ' class='btn btn-s btn-dark'>View to Comment</a></td>";                          
                            echo "<td> <button class='btn btn-s btn-primary mb-3 unpublishBtn'  value=" . $rowid . "> Unpublish </button></td>";                                                                                                                             
          
                      echo "</tr>";
                                                              
                }
                                                        
                } else {
                    echo "No results";
                    
                    echo "<tr>";
                    echo "<td></td>";    
                    echo "<td></td>";  
                    echo "<td></td>";  
                    echo "<td></td>";  
                    echo "<td></td>";    
              echo "</tr>";
                }

             
			
		
}

function getstudentsArticle($user, $conn){
	
    $query = "SELECT * FROM studentsubmission WHERE UserId='$user'";

    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $article[] = array(               
                "articletitle" => $row["StudentSubmissionName"],
                "desc" => $row["StudentSubmissionDescription"],
                "datetime" => $row['StudentSubmissionTime'],
                "status" => $row['StudentSubmissionStatus'],
                "userid" => $row['UserId'],
                "submissionid" => $row['SubmissionID'],
                "document" => $row['Document_url'],
                "image" => $row['Image_url'],
                "stusub" => $row['StudentSubmissionID']                
                 );
        
        }
        return $article;

    } else {
        echo "No Articles submitted yet";
    }
    
}

function getstudentsubmission($s, $conn){
	
    $query = "SELECT * FROM studentsubmission  INNER JOIN user ON studentsubmission.UserId = user.UserId  WHERE StudentSubmissionID='$s'";

    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $article[] = array(               
                "articletitle" => $row["StudentSubmissionName"],
                "desc" => $row["StudentSubmissionDescription"],
                "datetime" => $row['StudentSubmissionTime'],
                "status" => $row['StudentSubmissionStatus'],
                "userid" => $row['UserId'],
                "submissionid" => $row['SubmissionID'],
                "document" => $row['Document_url'],
                "image" => $row['Image_url'],
                "stusub" => $row['StudentSubmissionID'],
                "stuemail" => $row['UserEmail'],
                "stuname" => $row['UserName']
                
                 );
        
        }
        return $article;

    } else {
        echo "No Articles submitted yet";
    }
    
}

function getdocument($array, $conn){
    $array= trim($array,'\,');
    $temp = explode(',',$array);                                                       
    $s = array_filter($temp);                                                            
        foreach($s as $key => $ews)
        :   
       // $link[] ="<a href='document/$ews'>  $ews </a>";   
       $link[]= "<a href='document/$ews' download><button class='btn btn-outline-dark mb-3' type='button'><i class='fa fa-download'></i> &nbsp;$ews</button></a>";                                                         
        endforeach;

        $doclink = implode(" ", $link);
        echo $doclink;

}

function getimage($array, $conn){
    $array= trim($array,'\,');
    $temp = explode(',',$array);                                                       
    $s = array_filter($temp);                                                            
        foreach($s as $key => $ews)
        :   
        $a[] ="
            <a href='image/<?php echo $ews; ?>' data-lightbox='photos'>
            <img src='image/<?php echo $ews; ?>' class='img-fluid'/> </a>                               
        ";                                                            
        endforeach;

      

}

function getnotification($conn){
    $sql = "SELECT COUNT(*) AS num FROM request";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['num'];
}

function gettotalstudent($conn){
    $sql = "SELECT COUNT(*) AS num FROM user where UserRole = 'student'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['num'];
}

function s($s, $conn){
    $array= trim($array,'\,');
    $temp = explode(',',$array);                                                       
    $s = array_filter($temp);   
    $getimage = $s;
    for($i=0; $i<count($getimage); $i++){
       echo  '<img class="img-zoom" src="image/' . $getimage[$i] . '" width="200" height="150" alt="not fetched">&nbsp;&nbsp;';
    }
}

function disable($s,$f, $conn){
    $sql = "select * from Submission where AcademicYear = YEAR(CURDATE()) AND FacultyID =$f LIMIT 1;";
    $result = $conn->query($sql); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            $closure_date = $row["SubmissionClosureDate"];
            $date = date("Y-m-d");
            $news=base64_url_encode($s)  ;  
            if($date <= $closure_date){           
            echo ' <a href="upload.php?id='.$news.' " class="btn btn-m btn-dark mb-3">Submit Article</a>';
            }else{
            echo '<button type="submit" name="submit" value="Upload" class="btn btn-m btn-dark mb-3" disabled>You can no longer submit</button>' ;
            }
        }
    }
}

function closecomment($std, $conn){
    $sql = "select * from submission 
    INNER JOIN studentSubmission ON submission.SubmissionID= studentsubmission.SubmissionID
    where AcademicYear = YEAR(CURDATE()) AND studentsubmission.StudentSubmissionID=$std;";
    $result = $conn->query($sql); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  

            // $d_postpub = DateTime::createFromFormat('Y-m-d H:i:s', '2014-08-06 00:00:00');
           // $submiteddate= $row['StudentSubmissionTime'];
            // $timestamp = strtotime($row['StudentSubmissionTime']);
            // $date = date('d-m-Y', $timestamp);
            // $cutoff = new DateTime('-5 days'); 

            if(strtotime($row['StudentSubmissionTime']) > strtotime('-14 day') ) {
                echo '<button class="btn btn-primary btn-sm shadow-none" name="comment" type="submit">Post comment</button>
                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" name="back"  type="submit">Back</button></div>';
                             
            }else{
                echo '<button class="btn btn-primary btn-sm shadow-none" name="comment" type="submit" disabled>You can no longer comment</button>
                <button class="btn btn-outline-primary btn-sm ml-1 shadow-none" name="back"  type="submit">Back</button></div>';
            }
           
          
        }
    }
}

function getcoordinatordetails($g,$conn){

    $query = "SELECT * FROM user WHERE UserRole='coordinator' AND FacultyID=$g";
    $statement = $conn->query($query);            
    $result = $statement->fetch(PDO::FETCH_ASSOC);	
	
return $result['UserEmail'];

}

function updateComment($id, $comment,$user, $conn)
{
    $sql = "INSERT INTO comment (StudentSubmissionID, CommentDetail, UserId) VALUES ('" . $id . "', '" . $comment . "', '" . $user . "');";
    //echo ($sql);

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
       
    }
}



function checkComment($id,$conn){
    $sql = "SELECT * FROM comment WHERE StudentSubmissionID =" . $id . ";";
    $result = $conn->query($sql);

    if($result->rowCount() > 0){
        while($row = $result->fetch((PDO::FETCH_ASSOC))){ 

            $timestamp = $row["CommentCreateTime"];
            $splitTimeStamp = explode(" ",$timestamp);
            $date = $splitTimeStamp[0];
            $time = $splitTimeStamp[1];

            $date = date('Y-m-d', strtotime($date. ' + 14 days'));   
            $current_date = date("Y-m-d");
            if($date > $current_date){
                echo '<div class="row pt-3">
                    <label for="addComment">
                        <h5>Add a new comment</h5>
                    </label>
                </div><div id="addComment" >
                    <form action="" method="post">
                        <div class="form-group">
                            <textarea class="form-control" name="textComment" placeholder="Please insert your comment here."></textarea>
                            <button type="submit" class="btn btn-primary mt-2">Add comment</button>
                        </div>
                    </form>
                </div>';
            }else{
                echo '<div class="row pt-3">
                    <label for="addComment">
                        <h5>Comment are disabled by '.$date.'</h5>
                    </label>
                </div>';
            }
        }
    }
}
//Converting timestamp to time ago, eg : 2 hours ago
function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function getComment( $id,$coordinator, $conn){
    $sql = "SELECT * FROM comment WHERE StudentSubmissionID =" . $id . ";";
    $result = $conn->query($sql);

    if($result->rowCount() > 0){
        while($row = $result->fetch((PDO::FETCH_ASSOC))){            
            $timestamp = $row["CommentCreateTime"];
            $timeago=get_timeago(strtotime($row['CommentCreateTime']));            
            $comment = $row["CommentDetail"];
            $commentid = $row["CommentID"];

            echo ' <div class="commented-section mt-2">
            
                        <div class="d-flex flex-row align-items-center commented-user">
                         <h5 class="mr-2">'.$coordinator.'</h5>
                         <span class="dot mb-1">
                         </span>
                         <span class="mb-1 ml-2">'.$timeago.'</span>
                         </div>
                        <div class="comment-text-sm">
                        <span>'.$comment.'</span>
                        <div class="float-md-right">
                        <a href="delete-comment.php?commentid='.$commentid.'">Delete</a>
                        </div>
                        </div></div><hr>';
           
        }
    }
}

function getCoordinatorName($a,$conn){
    $query = "SELECT * FROM user WHERE UserRole='coordinator' AND FacultyID=$a";
    $statement = $conn->query($query);            
    $result = $statement->fetch(PDO::FETCH_ASSOC);	
	
    return $result['UserName'];
}

function getlastid($conn){
    $query = "SELECT * FROM faculty";
    $statement = $conn->query($query);            
    $result = $statement->fetch(PDO::FETCH_ASSOC);	
    $last_id = $conn->lastInsertId();
    return $last_id;
}

function checkpublished($z,$conn){
    $query = "SELECT * FROM studentsubmission WHERE StudentSubmissionID=$z";
    $statement = $conn->query($query);            
    $result = $statement->fetch(PDO::FETCH_ASSOC);	
	
    return $result['StudentSubmissionStatus'];
}

function getallfaculty($conn){
	
    $query = "SELECT * FROM faculty 
    WHERE FacultyID != '5' ";
    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $value[] = array(
                "id" => $row["FacultyID"],
                "fname" => $row["FacultyName"]
                 );
        
        }
        return $value;

    } else {
        echo "<center><p style='color:red;'><b>No faculy found in DB.</b></p></center>";
    }
    
}

function getallroles($conn){
	
    $query = "SELECT UserRole FROM user WHERE UserRole != 'admin' GROUP BY UserRole
    ";
    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $value[] = array(
                "role" => $row["UserRole"]
                
                 );
        
        }
        return $value;

    } else {
        echo "<center><p style='color:red;'><b>No role found in DB.</b></p></center>";
    }
    
}

function getalluserrole($role,$conn){
	
    $query = "SELECT * FROM user WHERE UserRole='$role' ORDER BY UserId desc ";
    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $stmt = $conn->prepare("SELECT * FROM faculty WHERE FacultyID =? ");     
            $stmt->execute(array($row['FacultyID']));
            $data = $stmt->fetch(PDO::FETCH_OBJ);   
            $facu= $data->FacultyName;
            //$newrowid=base64_url_encode($row['UserId'])  ;                 
            $newrowid=urlsafe_b64encode($row['UserId']);
     ?>
      <tr>
        <td ><?php echo $row['UserId']?></td>
        <td ><?php echo $row['UserName']?></td>
        <td ><?php echo $row['UserEmail']?></td>
        <td ><?php echo $facu?></td>
        <td><a href='edituser.php?id=<?php echo $newrowid ?>' class='btn btn-secondary ' 
                    onclick="return confirm('Do you really want to Edit the Account')"> Edit</a></td> 
        </tr>
        <?php
        
}
 } else {
        echo "<center><p style='color:red;'><b>No data found in DB.</b></p></center>";
    }
}

function getallarticleperfaculty($fid,$conn){
    // $sql = "SELECT * FROM submission INNER JOIN user ON submission.user_id = user.user_id 
    // WHERE faculty_id =" . $facultyId . ";";

    $query = "SELECT * FROM submission 
    INNER JOIN studentsubmission ON studentsubmission.SubmissionID = submission.SubmissionID
    INNER JOIN user ON studentsubmission.UserId = user.UserId
    WHERE submission.FacultyID= '$fid' AND studentsubmission.StudentSubmissionStatus='1' AND submission.AcademicYear= YEAR(CURDATE())";

    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $value[] = array(
                "student" => $row["UserId"], 
                "studentemail" => $row["UserEmail"],                
                "articletitle" => $row["StudentSubmissionName"],
                "desc" => $row["StudentSubmissionDescription"],
                "datetime" => $row['StudentSubmissionTime'],
                "status" => $row['StudentSubmissionStatus'],                
                "submissionid" => $row['SubmissionID'],
                "document" => $row['Document_url'],
                "image" => $row['Image_url'],
                "stusub" => $row['StudentSubmissionID']
                 );
        
        }
        return $value;

    } else {
        echo "<center><p style='color:red;'><b>No articles.</b></p></center>";
    }
    
}

function getacademicyear($conn){
    $query = "SELECT AcademicYear FROM submission GROUP by AcademicYear";
    $result = $conn->query($query); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){  
            
            $value[] = array(
                "year" => $row["AcademicYear"]                
                 );
        
        }
        return $value;

    } else {
        echo "<center><p style='color:red;'><b>No Results</b></p></center>";
    }
}


function viewcomment( $id,$coordinator, $conn){
    $sql = "SELECT * FROM comment WHERE StudentSubmissionID =" . $id . ";";
    $result = $conn->query($sql);

    if($result->rowCount() > 0){
        while($row = $result->fetch((PDO::FETCH_ASSOC))){            
            $timestamp = $row["CommentCreateTime"];
            $timeago=get_timeago(strtotime($row['CommentCreateTime']));            
            $comment = $row["CommentDetail"];
            $commentid = $row["CommentID"];

            echo ' <div class="commented-section mt-2">
            
                        <div class="d-flex flex-row align-items-center commented-user">
                         <h5 class="mr-2">'.$coordinator.'</h5>
                         <span class="dot mb-1">
                         </span>
                         <span class="mb-1 ml-2">'.$timeago.'</span>
                         </div>
                        <div class="comment-text-sm">
                        <span>'.$comment.'</span>
                       
                        </div></div><hr>';
           
        }
    }
}

function addfaculty($name,$conn){
    $num ="SELECT (MAX(FacultyID)+1) AS Max_val FROM faculty";
    $result = $conn->query($num);
    if($result->rowCount() > 0){
        while($row = $result->fetch((PDO::FETCH_ASSOC))){   
            $getid = $row["Max_val"];

          }
        }

    $sql = "INSERT INTO faculty (FacultyID, FacultyName) VALUES ($getid, '" . $name . "');";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
       
    }
}

 function addsubmission($name,$desc,$year, $start,$closure,$final,$fid,$conn){
    
  
    $sql = "INSERT INTO submission (`SubmissionName`, `SubmissionDescription`,`AcademicYear`,`SubmissionStartDate`, `SubmissionClosureDate`, `SubmissionFinalDate`, `FacultyID`) 
    VALUES ($name,$desc,$year, $start,$closure,$final,$fid);";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
       
    }
}

function generateId($conn)
{
	$num ="SELECT (MAX(SubmissionID)+1) AS Max_val FROM submission";
    $result = $conn->query($num);
    if($result->rowCount() > 0){
        while($row = $result->fetch((PDO::FETCH_ASSOC))){   
            $getid = $row["Max_val"];

          }
        }
        return $getid;
}

function upload_image()
{
	if(isset($_FILES["user_image"]))
	{
		$extension = explode('.', $_FILES['user_image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);
		return $new_name;
	}
}

function disableEditbtn($sid, $f, $conn){
    //$sql = "SELECT * from Submission where AcademicYear = YEAR(CURDATE()) AND FacultyID =$f";
    $sql = "SELECT * from Submission INNER JOIN studentsubmission ON submission.SubmissionID = studentsubmission.SubmissionID
    where submission.AcademicYear = YEAR(CURDATE()) AND submission.FacultyID =$f AND studentsubmission.StudentSubmissionID=$sid ";
    $result = $conn->query($sql); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){ 
            $final_date = $row["SubmissionFinalDate"]; 
            $status = $row["StudentSubmissionStatus"];
            $date = date("Y-m-d");                 
            if($date <= $final_date){     
             if($status == 0) {                     
                
              echo '<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
              <a href="student_upload.php" class="btn btn-default">Close</a>';
            }
              else{
                echo '<button type="submit" name="submit" value="Upload" class="btn btn-primary" disabled>You can no longer edit</button>&nbsp;
                <a href="student_upload.php" class="btn btn-default">Close</a>' ;
              }
            }
            else{
            echo '<button type="submit" name="submit" value="Upload" class="btn btn-primary" disabled>You can no longer edit</button>&nbsp;
            <a href="student_upload.php" class="btn btn-default">Close</a>
			' ;
            }
        }
    }
}

function disableSubmissionBtn( $subid,$conn){
    //$sql = "SELECT * from Submission where AcademicYear = YEAR(CURDATE()) AND FacultyID =$f";
    $sql = "SELECT * from Submission WHERE SubmissionID= $subid";
    $result = $conn->query($sql); 
    if($result->rowCount() > 0){
        while($row = $result->fetch()){ 
            $getyear = $row["AcademicYear"];   
            $curent_year = date("Y");             
            if($getyear >=  $curent_year)
            {                     
              echo '<button type="submit" name="add" class="btn btn-success btn-md mb-3">Save Changes</button>&nbsp;';
            }
              else{
                echo '<button type="submit" name="submit" value="Upload" class="btn btn-primary" disabled>You can no longer edit</button>&nbsp;
                ' ;
              }
          
        }
    }
}



?>









