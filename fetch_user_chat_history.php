<?php
session_start();
//fetch_user_chat_history.php

include('config.php');
function get_user_name($user_id, $conn)
{
 $query = "SELECT UserName FROM user WHERE UserId = '$user_id'";
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row['UserName'];
 }
}

function fetch_user_chat_history($from_user_id, $to_user_id, $conn)
{
 $query = "
 SELECT * FROM chat_message 
 WHERE (from_user_id = '".$from_user_id."' 
 AND to_user_id = '".$to_user_id."') 
 OR (from_user_id = '".$to_user_id."' 
 AND to_user_id = '".$from_user_id."') 
 ORDER BY timestamp DESC
 ";
 $statement = $conn->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $output = '<ul class="list-unstyled">';
 foreach($result as $row)
 {
  $user_name = '';
  if($row["from_user_id"] == $from_user_id)
  {
   $user_name = '<b class="text-success">You</b>';
  }
  else
  {
   $user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $conn).'</b>';
  }
  $output .= '
  <li style="border-bottom:1px dotted #ccc">
   <p>'.$user_name.' - '.$row["chat_message"].'
    <div align="right">
     - <small><em>'.$row['timestamp'].'</em></small>
    </div>
   </p>
  </li>
  ';
 }
 $output .= '</ul>';
 return $output;
}
function count_unseen_message($from_user_id, $to_user_id, $conn)
        {
        $query = " SELECT * FROM chat_message 
        WHERE from_user_id = '".$from_user_id."'
        AND to_user_id = '".$to_user_id."'
        AND status = 1
        "; 
        $statement = $conn->prepare($query);
        $statement->execute();
        $count = $statement->rowCount();
        $output = '';
        if($count > 0)
        {
        $output = '<span class="label label-success">'.$count.'</span>';
        }
        return $output;
        }

echo fetch_user_chat_history($_SESSION['userid'], $_POST['to_user_id'], $conn);

?>